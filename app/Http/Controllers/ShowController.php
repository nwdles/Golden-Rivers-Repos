<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Show;


/**
 * Class ShowController
 * @package App\Http\Controllers
 *
 */
class ShowController extends Controller
{
    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';

    /**
     * @param Request $request
     * @return array
     *
     * Создать Выставку
     */
    public function createShow(Request $request) {
        $rules = [
            'show_name' => 'required|string',
            'show_full_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'show_short_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'show_cost_ticket' => 'required|numeric',
            'show_date_from' => 'required|date',
            'show_date_to' => 'required|date',
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

        try {

            DB::beginTransaction();

            /*$fileName = Hash::make( \Auth::user()->user_login).'.jpg';
            $path = $request
                ->file('show_full_img')
                ->move(public_path("/images/show"), $fileName);*/
            if($request->hasFile('show_item_imf')) {
                $path = $request->file('show_full_img')
                    ->store('images/' . Auth::user()->user_id, 'public');

//            $photoURL = url('/storage/'.$path);
//            return asset('storage/'.$path);

                $validateData['show_full_img'] = $path;
            }
            $validateData['user_id'] = Auth::user()->user_id;

            $newShow = Show::create($validateData);


            DB::commit();
            return [
                'status' => self::OK,
                'payload' => $newShow
            ];

        } catch (\Exception $err ) {
            DB::rollBack();
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }

    /**
     * @return array
     *
     * Получить все выставки
     */
    public function getAllShows() {
        try {

            $shows = Show::all();

            return [
                'status' => self::OK,
                'payload' => $shows
            ];


        } catch (\Exception $err) {

            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }
}
