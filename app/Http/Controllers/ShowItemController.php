<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\ShowItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ShowItemController
 * @package App\Http\Controllers
 *
 */
class ShowItemController extends Controller
{

    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';


    /**
     * @param Request $request
     * @return array
     *
     * СОздание айтема вытсавки
     */
    public function createShowItem (Request $request) {
        $rules = [
            'show_id' => 'required|integer|exists:shows,show_id',
            'show_item_name' => 'required|string',
            'show_item_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'show_item_info' => 'required|string',
            'show_item_date_creation' => 'required|date',
            'show_item_author_fullname' => 'required|string',
        ];
        try {
            $validateData = $this->validate($request, $rules);


        } catch (\Exception $err) {
            \Log::error($err);

            return [
                'status' => self::VALIDATION_ERROR
            ];
        }

        try{
            DB::beginTransaction();


            if($request->hasFile('show_item_imf')) {
                $path = $request->file('show_item_img')
                    ->store('images/' . Auth::user()->user_id, 'public');


                $validateData['show_item_img'] = $path;
            }

            $newItem = ShowItem::create($validateData);

            DB::commit();

            return [
                'status' => self::OK,
                'payload' => $newItem
            ];

        } catch (\Exception $err) {
            DB::rollBack();
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }


    /**
     * @param $show_id
     * @return array
     *
     * Все айтемы выставки
     */
    public function getShowItemsById ($show_id) {

        try {

            $show = Show::find($show_id);
            if($show) {

                $items = ShowItem::where('show_id', $show_id)
                    ->orderBy('show_item_name', 'asc')
                    ->get();

                return [
                  'status' => self::OK,
                  'payload' => $items
                ];

            } else {
                return [
                    'status' => self::VALIDATION_ERROR
                ];
            }

        } catch (\Exception $err) {

            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }
}
