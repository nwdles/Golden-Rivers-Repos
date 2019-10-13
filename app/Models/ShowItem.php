<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowItem extends Model
{
    protected $primaryKey = 'show_item_id';
    public $timestamps = false;


    protected $fillable = [
        'show_item_name',
        'show_item_img',
        'show_id',
        'show_item_info',
        'show_item_date_creation',
        'show_item_author_fullname'
    ];

    public function show()
    {
        return $this->belongsTo(Show::class, 'show_id', 'show_id');
    }
}
