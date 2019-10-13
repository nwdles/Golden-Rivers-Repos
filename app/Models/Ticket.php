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
}
