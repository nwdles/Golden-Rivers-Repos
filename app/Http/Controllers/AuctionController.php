<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuctionController
 * @package App\Http\Controllers
 *
 */

class AuctionController extends Controller
{
    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';

    public function index(){
        $auctions = $this->getAllAuctions();

        return view('home.auctions.auctions', compact('auctions'));
    }

    public function pageCreate()
    {
        return view('home.auctions.createauction');
    }

    public function creating(Request $request) {

        $res = $this->createAuction($request);
        if($res['status'] === 'OK')
        {
            return redirect()->back()->with('success', 'Заявка на открытие аукциона успешно отправлена');
        }
        else
            return redirect()->back()->with('success', $res['status']);
    }
    public function pageEdit($id) {
        if(Auth::check() && Auth::user()->isAdmin() ) {
            return view('home.auctions.editauction', compact('id'));
        } else abort(404);
    }

    public function update(Request $request, $id) {
        if(Auth::check() && Auth::user()->isAdmin() ) {
            $request['auction_id'] = $id;
            $res = $this->editAuction($request);

            if ($res['status'] === 'OK') {
                return redirect()->route('auctions')->with('success', 'Аукцион успешно изменен');
            } else
                return redirect()->route('auctions')->with('success', $res['status']);
        } else abort(404);
    }
    public function delete($id)
    {
        if(Auth::check() && Auth::user()->isAdmin() ) {
            $res = $this->deleteAuction($id);

            if ($res['status'] === 'OK') {
                return redirect()->route('auctions')->with('success', 'Аукцион успешно удален');
            } else
                return redirect()->route('auctions')->with('success', $res['status']);
        } else abort(404);
    }

    /**
     * @param Request $request
     * @return array
     *
     * Создание аукциона
     */
    public function createAuction(Request $request) {
        $rules = [
            'auction_name' => 'required|string',
            'auction_full_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auction_short_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auction_cost_ticket' => 'required|numeric',
            'auction_date' => 'required|date',
        ];
        try {
            $validateData = $this->validate($request, $rules);


        } catch (\Exception $err) {
            \Log::error($err);

           // $validator=Validator::make($request->all(),$rules);
           // dump($validator->errors());

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

            if($request->hasFile('auction_full_img')) {
                $path = $request->file('auction_full_img')
                    ->store('images/' . $userID, 'public');


                $validateData['auction_full_img'] = $path;
            }

            if($request->hasFile('auction_short_img')) {
                $path = $request->file('auction_short_img')
                    ->store('images/' . $userID, 'public');


                $validateData['auction_short_img'] = $path;
            }

            $validateData['user_id'] = $userID;

            $newAuction = Auction::create($validateData);


            DB::commit();
            return [
                'status' => self::OK,
                'payload' => $newAuction
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
     * Все аукционы
     */
    public function getAllAuctions() {
        try {

            $auctions = Auction::all();

            return [
                'status' => self::OK,
                'payload' => $auctions
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
     * Изменение аукциона
     */
    public function editAuction(Request $request) {
        $rules = [
            'auction_id' => 'required|integer|exists:auctions,auction_id',
            'auction_name' => 'required|string',
            'auction_full_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auction_short_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auction_cost_ticket' => 'required|numeric',
            'auction_date' => 'required|date',
        ];
        try {
            $validateData = $this->validate($request, $rules);


        } catch (\Exception $err) {
            \Log::error($err);

            $validator=Validator::make($request->all(),$rules);
            dump($validator->errors());

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

            if(!empty($validateData['auction_name'])){
                $requestUpd['auction_name'] = $validateData['auction_name'];
                $emptyFlag = false;
            }

            if(!empty($validateData['auction_cost_ticket'])){
                $requestUpd['auction_cost_ticket'] = $validateData['auction_cost_ticket'];
                $emptyFlag = false;
            }

            if(!empty($validateData['auction_date'])){
                $requestUpd['auction_date'] = $validateData['auction_date'];
                $emptyFlag = false;
            }


            if(!empty($validateData['auction_full_img'])){
                $path = $request->file('auction_full_img')
                    ->store('images/' . $userID, 'public');
                $requestUpd['auction_full_img'] = $path;

                $emptyFlag = false;
            }

            if(!empty($validateData['auction_short_img'])){
                $path = $request->file('auction_short_img')
                    ->store('images/' . $userID, 'public');

                $requestUpd['auction_short_img'] = $path;
                $emptyFlag = false;
            }



            if(!$emptyFlag){

                $updatedRows = Auction::where('auction_id', $validateData['auction_id'])
                    ->update($requestUpd);

            }

            DB::commit();
            return  [
                'status' => self::OK,
                'updated_auction_id' => $validateData['auction_id']
            ];

        } catch (\Exception $err ) {
            DB::rollBack();
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }

    public function deleteAuction($auction_id)
    {
        $auction = Auction::find($auction_id);
        if($auction)
        {
            try {
                DB::beginTransaction();

                AuctionItem::where('auction_id',$auction_id)
                    ->delete();
                Auction::where('auction_id', $auction_id)
                    ->delete();
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
