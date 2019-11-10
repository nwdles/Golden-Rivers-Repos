<?php

namespace App\Http\Controllers;

use App\Models\ShowItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Show;
use Illuminate\Support\Facades\Validator;


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


    public function index(){
        $shows = $this->getAllShows();

        return view('home.shows.index', compact('shows'));
    }

    public function pageCreate()
    {
        return view('home.shows.createshow');
    }

    public function creating(Request $request) {

        $res = $this->createShow($request);
        if($res['status'] === 'OK')
        {
            return redirect()->back()->with('success', 'Заявка на открытие выставки успешно отправлена');
        }
        else
            return redirect()->back()->with('success', $res['status']);
    }

    public function pageEdit($id) {
        return view('home.shows.editshow',compact('id'));
    }

    public function update(Request $request, $id) {
        $request['show_id'] = $id;
        $res = $this->editShow($request);

        if($res['status'] === 'OK')
        {
            return redirect()->route('shows')->with('success', 'Выставка успешно изменена');
        }
        else
            return redirect()->route('shows')->with('success', $res['status']);
    }
    public function delete($id)
    {

        $res = $this->deleteShow($id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('shows')->with('success', 'Выставка успешно удалена');
        }
        else
            return redirect()->route('shows')->with('success', $res['status']);
    }
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

            if(Auth::check())
                $userID = Auth::user()->user_id;
            else
                $userID = 1;

            /*$fileName = Hash::make( \Auth::user()->user_login).'.jpg';
            $path = $request
                ->file('show_full_img')
                ->move(public_path("/images/show"), $fileName);*/
            if($request->hasFile('show_full_img')) {
                $path = $request->file('show_full_img')
                    ->store('images/' . $userID, 'public');

//            $photoURL = url('/storage/'.$path);
//            return asset('storage/'.$path);

                $validateData['show_full_img'] = $path;
            }
            if($request->hasFile('show_short_img')) {
                $path = $request->file('show_short_img')
                    ->store('images/' . $userID, 'public');


                $validateData['show_short_img'] = $path;
            }

                $validateData['user_id'] = $userID;


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

    /**
     * @param Request $request
     * @return array
     *
     * Изменение данных выставки
     */
    public function editShow(Request $request) {
        $rules = [
            'show_id' => 'required|integer|exists:shows,show_id',
            'show_name' => 'string',
            'show_full_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'show_short_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'show_cost_ticket' => 'numeric',
            'show_date_from' => 'date',
            'show_date_to' => 'date',
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

            if(Auth::check())
                $userID = Auth::user()->user_id;
            else
                $userID = 1;

            $emptyFlag = true;
            $requestUpd = [];

            if(!empty($validateData['show_name'])){
                $requestUpd['show_name'] = $validateData['show_name'];
                $emptyFlag = false;
            }

            if(!empty($validateData['show_cost_ticket'])){
                $requestUpd['show_cost_ticket'] = $validateData['show_cost_ticket'];
                $emptyFlag = false;
            }

            if(!empty($validateData['show_date_from'])){
                $requestUpd['show_date_from'] = $validateData['show_date_from'];
                $emptyFlag = false;
            }

            if(!empty($validateData['show_date_to'])){
                $requestUpd['show_date_to'] = $validateData['show_date_to'];
                $emptyFlag = false;
            }

            if(!empty($validateData['show_full_img'])){
                $path = $request->file('show_full_img')
                    ->store('images/' . $userID, 'public');
                $requestUpd['show_full_img'] = $path;

                $emptyFlag = false;
            }

            if(!empty($validateData['show_short_img'])){
                $path = $request->file('show_short_img')
                    ->store('images/' . $userID, 'public');

                $requestUpd['show_short_img'] = $path;
                $emptyFlag = false;
            }



            if(!$emptyFlag){

                $updatedRows = Show::where('show_id', $validateData['show_id'])
                    ->update($requestUpd);

                }

            DB::commit();
            return  [
                'status' => self::OK,
                'updated_show_id' => $validateData['show_id']
            ];

        }
        catch (\Exception $err)
        {
            DB::rollBack();
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }

    }
    public function deleteShow($show_id)
    {
        $show = Show::find($show_id);
        if($show)
        {
            try {
                DB::beginTransaction();

                ShowItem::where('show_id',$show_id)
                    ->delete();
                $show->delete();
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
