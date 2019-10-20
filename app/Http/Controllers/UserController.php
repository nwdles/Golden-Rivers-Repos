<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
            'user_sex' => 'required|boolean',
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
    public function getPersonalData(Request $request) {
        try {

            return [
                'status' => self::OK,
                'payload' => new UserResource(User::find(Auth::user()->user_id))
            ];

        } catch (\Exception $err) {
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }
}
