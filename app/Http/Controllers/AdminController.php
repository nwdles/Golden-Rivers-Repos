<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Show;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminController extends Controller
{
    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';
    const USER_DOES_NOT_EXIST = 'USER_DOES_NOT_EXIST';

    public function index()
    {
        $users = $this->getAllUsers();

        return view('home.adminpanel.home', compact('users'));
    }

    public function activate($user_id)
    {

        $res = $this->activateUser($user_id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('admin.panel')->with('success', 'Пользователь подтвержден');
        }
        else
            return redirect()->route('admin.panel')->with('success', $res['status']);
    }

    public function showAll()
    {
        $shows = Show::all();

        return view('home.adminpanel.shows', compact('shows'));
    }
    public function activateShowByID($show_id)
    {

        $res = $this->activateShow($show_id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('admin.panel.shows')->with('success', 'Выставка подтверждена');
        }
        else
            return redirect()->route('admin.panel.shows')->with('success', $res['status']);
    }

    public function auctionAll()
    {
        $auctions = Auction::all();

        return view('home.adminpanel.auctions', compact('auctions'));
    }
    public function activateAuctionByID($auction_id)
    {

        $res = $this->activateAuction($auction_id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('admin.panel.auctions')->with('success', 'Аукцион подтвержден');
        }
        else
            return redirect()->route('admin.panel.auctions')->with('success', $res['status']);
    }

    public function ticketAll()
    {
        $tickets = Ticket::all();

        return view('home.adminpanel.ticket', compact('tickets'));
    }
    public function activateTicketByID($ticket_id)
    {

        $res = $this->activateTicket($ticket_id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('admin.panel.tickets')->with('success', 'Билет подтвержден');
        }
        else
            return redirect()->route('admin.panel.tickets')->with('success', $res['status']);
    }
    /**
     * @param Request $request
     * @return array
     *
     * Получение всех пользователей
     */
    public function getAllUsers()
    {

        if(1 || Auth::user()->isAdmin() )
        {
            try {

                $users = User::with('role')->orderBy('user_fullname', 'asc')->get();

                return [
                    'status' => self::OK,
                    'payload' => $users
                ];

            } catch (\Exception $err) {
                return [
                  'status' => self::UNKNOWN_ERROR
                ];
            }


        } else {
            return [
                'status' => self::NOT_ACCESS
            ];
        }
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return array
     *
     * Получение одного пользователя
     */
    public function getOneUser(Request $request, $user_id)
    {
        if(Auth::user()->isAdmin()) {
            try {
                $findUser = User::with('role')->find($user_id);
                if ($findUser) {


                    return [
                        'status' => self::OK,
                        'payload' => $findUser
                    ];
                } else {
                    return [
                        'status' => self::USER_DOES_NOT_EXIST
                    ];
                }

            } catch (\Exception $err) {
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }
        } else {
            return [
                'status' => self::NOT_ACCESS
            ];
        }

    }

    /**
     * @param Request $request
     * @return array
     *
     * Изменить данные пользователя
     */
    public function updateUser(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer|exists:users,user_id',
            'user_login' => 'string|max:255',
            'user_new_pass' => 'string|min:6|confirmed',
            'user_fullname' => 'string|max:255',
            'user_email' => 'email',
            'user_phone'=>'digits_between:6,10|numeric',
            'user_sex' => 'boolean',
            'user_status' => 'boolean',
            'role_id' => 'integer|exists:roles,role_id'
        ];
        try {
            $validateData = $this->validate($request, $rules);


        } catch (\Exception $err) {
            \Log::error($err);

//            $validator=Validator::make($request->all(),$rules);
//            dump($validator->errors());

            return [
                'status' => self::VALIDATION_ERROR
            ];
        }

        if(Auth::user()->isAdmin()) {

            try {

                DB::beginTransaction();

                $requestUpd = [];
                $emptyFlag = true;

                if(!empty($validateData['user_login'])){
                    $requestUpd['user_login'] = $validateData['user_login'];
                    $emptyFlag = false;
                }
                if(!empty($validateData['user_email'])){
                    $requestUpd['user_email'] = $validateData['user_email'];
                    $emptyFlag = false;
                }
                if(!empty($validateData['user_new_pass'])){
                    $requestUpd['user_hash_pass'] = Hash::make($validateData['user_new_pass']);
                    $emptyFlag = false;
                }
                if(!empty($validateData['user_phone'])){
                    $requestUpd['user_phone'] = $validateData['user_phone'];
                    $emptyFlag = false;
                }
                if(!empty($validateData['user_fullname'])){
                    $requestUpd['user_fullname'] = $validateData['user_fullname'];
                    $emptyFlag = false;
                }
                if(array_key_exists('user_sex',$validateData)){
                    $requestUpd['user_sex'] = $validateData['user_sex'];
                    $emptyFlag = false;
                }
                if(!empty($validateData['role_id'])){
                    $requestUpd['role_id'] = $validateData['role_id'];
                    $emptyFlag = false;
                }
                if(array_key_exists('user_status',$validateData)){
                    $requestUpd['user_status'] = $validateData['user_status'];
                    $emptyFlag = false;
                }


                if(!$emptyFlag) {
                    $updatedRows = User::where('user_id', $validateData['user_id'])
                        ->update($requestUpd);
                }

                DB::commit();

                return [
                    'status' => self::OK,
                    'payload' =>
                        [
                            'updated_user_id' => $updatedRows
                        ]
                ];

            } catch (\Exception $err) {

                DB::rollBack();
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }

        } else {
            return [
                'status' => self::NOT_ACCESS
            ];
        }

    }

    /**
     * @param Request $request
     * @param $user_id
     * @return array
     *
     * Удалить пользователя
     */
    public function deleteUser(Request $request, $user_id) {

        if(Auth::user()->isAdmin()) {

            try {

                $user = User::find($user_id);
                if($user) {
                    $user->delete();

                    return [
                        'status' => self::OK
                    ];
                } else {
                    return [
                        'status' => self::USER_DOES_NOT_EXIST
                    ];
                }
            } catch (\Exception $err) {

                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }


        } else {
            return [
                'status' => self::NOT_ACCESS
            ];
        }
    }

    public function activateUser($user_id)
    {
        $user = User::find($user_id);
        if($user) {
            try {

                DB::beginTransaction();


                $user->update([
                    'user_status' => true
                ]);

                DB::commit();
                return [
                    'status'=>self::OK
                ];

            } catch (\Exception $err) {
                DB::rollBack();
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }
        }
        else {
            return [
                'status' => self::VALIDATION_ERROR
            ];
        }
    }

    public function activateShow($show_id)
    {
        $show = Show::find($show_id);
        if($show) {
            try {

                DB::beginTransaction();


                $show->update([
                    'show_status' => true
                ]);

                DB::commit();
                return [
                    'status'=>self::OK
                ];

            } catch (\Exception $err) {
                DB::rollBack();
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }
        }
        else {
            return [
                'status' => self::VALIDATION_ERROR
            ];
        }
    }
    public function activateAuction($auction_id)
    {
        $auction = Show::find($auction_id);
        if($auction) {
            try {

                DB::beginTransaction();


                $auction->update([
                    'auction_status' => true
                ]);

                DB::commit();
                return [
                    'status'=>self::OK
                ];

            } catch (\Exception $err) {
                DB::rollBack();
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }
        }
        else {
            return [
                'status' => self::VALIDATION_ERROR
            ];
        }
    }

    public function activateTicket($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        if($ticket) {
            try {

                DB::beginTransaction();


                $ticket->update([
                    'ticket_status' => true
                ]);

                DB::commit();
                return [
                    'status'=>self::OK
                ];

            } catch (\Exception $err) {
                DB::rollBack();
                return [
                    'status' => self::UNKNOWN_ERROR
                ];
            }
        }
        else {
            return [
                'status' => self::VALIDATION_ERROR
            ];
        }
    }



}
