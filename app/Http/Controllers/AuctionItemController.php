<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionItemController extends Controller
{
    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';

    public function index($id){
        $auctionItems = $this->getAuctionItemsById($id);

        return view('home.auctions.auctionitems', compact(['auctionItems', 'id']));
    }

    public function pageCreateItem($id)
    {
        return view('home.auctions.createauctionitem', compact('id'));
    }

    public function creatingItem(Request $request, $id) {

        $request['auction_id'] = $id;
        $res = $this->createAuctionItem($request);
        if($res['status'] === 'OK')
        {
            return redirect()->back()->with('success', 'Предмет успешно добавлен');
        }
        else
            return redirect()->back()->with('success', $res['status']);
    }
    public function delete($auction_id, $item_id)
    {

        $res = $this->deleteAuctionItem($auction_id,$item_id);

        if($res['status'] === 'OK')
        {
            return redirect()->route('auction.items',$auction_id)->with('success', 'Предмет аукциона успешно удален');
        }
        else
            return redirect()->route('auction.items',$auction_id)->with('success', $res['status']);
    }

    /**
     * @param Request $request
     * @return array
     *
     * Сoздание айтема аукциона
     */
    public function createAuctionItem (Request $request) {
        $rules = [
            'auction_id' => 'required|integer|exists:auctions,auction_id',
            'auction_item_name' => 'required|string',
            'auction_item_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'auction_item_info' => 'required|string',
            'auction_item_cost' => 'required|numeric',
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

            if($request->hasFile('auction_item_img')) {
                $path = $request->file('auction_item_img')
                    ->store('images/' . $userID, 'public');


                $validateData['auction_item_img'] = $path;
            }

            $newItem = AuctionItem::create($validateData);

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
     * Айтемы аукциона
     */
    public function getAuctionItemsById ($auction_id) {

        try {

            $auction = Auction::find($auction_id);
            if($auction) {

                $items = AuctionItem::where('auction_id', $auction_id)
                    ->orderBy('auction_item_name', 'asc')
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

    public function deleteAuctionItem($auction_id, $auction_item_id)
    {
        $auctionItem = AuctionItem::where([
            'auction_id' => $auction_id,
            'auction_item_id' => $auction_item_id
        ]);
        if($auctionItem)
        {
            try {
                DB::beginTransaction();

                $auctionItem->delete();

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
