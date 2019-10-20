<?php

namespace App\Http\Controllers;

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

    /**
     * @param Request $request
     * @return array
     *
     * Получение всех пользователей
     */
    public function getAllUsers(Request $request)
    {

        if(Auth::user()->isAdmin())
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

            $result = [
                'status' => self::OK
            ];


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

}
