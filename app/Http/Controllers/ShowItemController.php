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

    public function index($id){
        $showItems = $this->getShowItemsById($id);

        return view('home.shows.showitems', compact('showItems', 'id'));
    }

    public function pageCreateItem($id)
    {
        $user = Show::find($id)['user_id'];
        if( Auth::user()->user_id ==$user || Auth::user()->isAdmin() ) {
            return view('home.shows.createshowitem', compact('id'));
        } else abort(404);
    }

    public function creatingItem(Request $request, $id) {

        $request['show_id'] = $id;
        $user = Show::find($id)['user_id'];
        if( Auth::user()->user_id ==$user || Auth::user()->isAdmin() ) {
            $res = $this->createShowItem($request);
            if ($res['status'] === 'OK') {
                return redirect()->back()->with('success', 'Предмет успешно добавлен');
            } else
                return redirect()->back()->with('success', $res['status']);
        } else abort(404);
    }
    public function delete($show_id, $item_id)
    {
        if(Auth::check() && Auth::user()->isAdmin() ) {

            $res = $this->deleteShowItem($show_id, $item_id);

            if ($res['status'] === 'OK') {
                return redirect()->route('show.items', $show_id)->with('success', 'Предмет выставки успешно удален');
            } else
                return redirect()->route('show.items', $show_id)->with('success', $res['status']);
        } else abort(404);
    }

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
            'show_item_date_creation' => 'required|string',
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

            if(Auth::check())
                $userID = Auth::user()->user_id;
            else
                $userID = 1;

            if($request->hasFile('show_item_img')) {
                $path = $request->file('show_item_img')
                    ->store('images/' . $userID, 'public');


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

    public function deleteShowItem($show_id, $show_item_id)
    {
        $showItem = ShowItem::where([
            'show_id' => $show_id,
            'show_item_id' => $show_item_id
            ]);
        if($showItem)
        {
            try {
                DB::beginTransaction();

                $showItem->delete();

                DB::commit();

                //Запись рез-тов удаления
                return [
                    'status' => self::OK
                ];


            }
            catch (\Exception $err) {
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
