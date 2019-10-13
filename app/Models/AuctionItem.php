<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    protected $primaryKey = 'auction_item_id';
    public $timestamps = false;


    protected $fillable = [
        'auction_item_name',
        'auction_item_img',
        'auction_id',
        'auction_item_info',
        'auction_item_cost'
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'auction_id');
    }
}
