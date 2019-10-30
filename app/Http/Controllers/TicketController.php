<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */

class TicketController extends Controller
{
    const OK = 'OK';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const VALIDATION_ERROR = 'VALIDATION_ERROR';
    const NOT_ACCESS = 'NOT_ACCESS';

    public function buyTicket(Request $request) {
        $rules = [
            'auction_id' => 'required_without:show_id|integer|exists:auctions,auction_id',
            'show_id' => 'integer|exists:shows,show_id',
            'ticket_comment' => 'required|string',

        ];
        try {
            $validateData = $this->validate($request, $rules);

            if(array_key_exists('auction_id',$validateData) && array_key_exists('show_id', $validateData)) {
                return [
                    'status' => self::VALIDATION_ERROR
                ];
            }


        } catch (\Exception $err) {
            \Log::error($err);

            return [
                'status' => self::VALIDATION_ERROR
            ];
        }

        try {

            DB::beginTransaction();

            $validateData ['user_id'] = \Auth::user()->user_id;
            $validateData ['ticket_status'] = false;


            $ticket = Ticket::create($validateData);

            DB::commit();

            return [
                'status' => self::OK,
                'payload' => $ticket
            ];

        } catch (\Exception $err) {

            DB::rollBack();
            return [
                'status' => self::UNKNOWN_ERROR
            ];
        }
    }
}
