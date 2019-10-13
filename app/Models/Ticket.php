<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $primaryKey = 'ticket_id';
    public $timestamps = false;


    protected $fillable = [
        'user_id',
        'ticket_status',
        'auction_id',
        'show_id',
        'ticket_comment'
    ];

    public function show()
    {
        return $this->belongsTo(Show::class, 'show_id', 'show_id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'auction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
