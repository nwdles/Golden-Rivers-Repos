<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $primaryKey = 'auction_id';
    public $timestamps = false;


    protected $fillable = [
        'auction_name',
        'auction_full_img',
        'auction_short_img',
        'auction_cost_ticket',
        'auction_date',
        'user_id',
        'auction_status'
    ];
}
