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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function auctionitems()
    {
        return $this->hasMany(AuctionItem::class, 'auction_id','auction_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'auction_id', 'auction_id');
    }
}
