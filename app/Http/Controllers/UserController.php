<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 * @package App\Http\Controllers
 *
 */
class UserController extends Controller
{

    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';
    const LOGIN_PHONE_AND_EMAIL_MUST_BE_UNIQUE = 'LOGIN_PHONE_AND_EMAIL_MUST_BE_UNIQUE';

    public function index()
    {
        $data = $this->getPersonalData();
        $show = $this->getAllEvents();

        return view('home.lk.main', compact(['data', 'show']));
    }

    public function createUser(Request $request)
    {
        $res = $this->register($request);

        if($res['status'] === 'OK')
        {
            return redirect()->route('register')->with('success', 'Регистрация прошла успешно');
        }
        else
            return redirect()->route('register')->with('success', $res['status']);
    }

    /**
     * @param Request $request
     * @return array
     *
     * Регистрация пользователя
     */
    public function register(Request $request)
    {
        $rules= [
            'user_login' => 'required|string|max:255',
            'user_pass' => 'required|string|min:6|confirmed',
            'user_fullname' => 'required|string|max:255',
            'user_email' => 'required|email',
            'user_phone'=>'required|digits_between:6,10|numeric',
            'user_sex' => 'required',
        ];

        try {
            $validateData = $this->validate($request, $rules);

        } catch (\Exception $err) {
            \Log::error($err);

            return [
                'status' => self::VALIDATION_ERROR
            ];
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'user_login' => $validateData['user_login'],
                'user_hash_pass' => Hash::make($validateData['user_pass']),
                'user_fullname' => $validateData['user_fullname'],
                'user_email' => $validateData['user_email'],
                'user_phone' => $validateData['user_phone'],
                'user_sex' => $validateData['user_sex'],
                'user_status' => false,
                'role_id' => 2,
            ]);

            $result = (new UserResource($user))->jsonSerialize();

            DB::commit();
            return [
                'status' => self::OK,
                'payload' => $result
            ];
        } catch (\Exception $err) {
            DB::rollBack();
            // Обработка ошибок из БД
            if (preg_match('/^SQLSTATE\[23505\]:[\s\S]*$/', $err->getMessage())) {
                $status = self::LOGIN_PHONE_AND_EMAIL_MUST_BE_UNIQUE;
            } else {
                $status = self::UNKNOWN_ERROR;
            }

            return  [
                'status' => $status
            ];
        }

    }

    /**
     * @param Request $request
     * @return array
     *
     * Получить персональные данные пользователя
     */
    public function getPersonalData() {
        try {

            if(Auth::check())
                $userID = Auth::user()->user_id;
            else
                $userID = 1;

            return [
                'status' => self::OK,
                'payload' => new UserResource(User::find($userID))
            ];

        } catch (\Exception $err) {
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }

    public function getAllEvents()
    {
        try {

            if(Auth::check())
                $userID = Auth::user()->user_id;
            else
                $userID = 1;

            $resShow = User::select([
                'show_name',
                'show_id',
                'show_status',
                DB::raw('(select count(show_name)
											from users
											join shows using (user_id)
											where user_id = '.$userID.') as count_row')
            ])
                ->join('shows',
                    'shows.user_id',
                    'users.user_id')
                ->where('users.user_id', $userID)
                ->groupBy(['show_name', 'show_id', 'show_status'])
                ->orderBy('show_name')
                ->get();

            $resAuction = User::select([
                'auction_name',
                'auction_id',
                'auction_status',
                DB::raw('(select count(auction_name)
											from users
											join auctions using (user_id)
											where user_id = '.$userID.') as count_row')
            ])
                ->join('auctions',
                    'auctions.user_id',
                    'users.user_id')
                ->where('users.user_id', $userID)
                ->groupBy(['auction_name', 'auction_id', 'auction_status'])
                ->orderBy('auction_name')
                ->get();

            $resTicket = User::select([
                'ticket_id',
                'ticket_status',
                'shows.show_id',
                'show_name',
                'auctions.auction_id',
                'auction_name',
                DB::raw('(select count(ticket_id)
											from users
											join tickets using (user_id)
											where user_id = '.$userID.') as count_row')
            ])
                ->join('tickets',
                    'tickets.user_id',
                    'users.user_id')
                ->leftJoin('shows',
                    'shows.show_id',
                    'tickets.show_id')
                ->leftJoin('auctions',
                    'auctions.auction_id',
                    'tickets.auction_id')
                ->where('users.user_id', $userID)
                ->groupBy(['ticket_id', 'ticket_status', 'shows.show_id', 'show_name', 'auctions.auction_id', 'auction_name'])
                ->get();

            return [
                'status' => self::OK,
                'payload' => [
                    'shows' => $resShow,
                    'auctions' => $resAuction,
                    'tickets' => $resTicket
                ]
            ];


        } catch(\Exception $err) {
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }

    }
}
