<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $primaryKey = 'show_id';
    public $timestamps = false;


    protected $fillable = [
        'show_name',
        'show_full_img',
        'show_short_img',
        'show_cost_ticket',
        'show_date_from',
        'show_date_to',
        'user_id',
        'show_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function showitems()
    {
        return $this->hasMany(ShowItem::class, 'show_id','show_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'show_id', 'show_id');
    }
}
