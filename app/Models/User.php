<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_login',
        'user_email',
        'user_hash_pass',
        'user_phone',
        'user_fullname',
        'user_sex',
        'role_id',
        'user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_hash_pass',
    ];

    public function isAdmin()
    {
        if($this->role_id == 1)
            return true;
        else false;
    }


    public function findForPassport($username) {
        return self::where('user_login', $username)->first();
    }

    public function getAuthPassword()
    {
        return $this->user_hash_pass;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function shows()
    {
        return $this->hasMany(Show::class, 'user_id', 'user_id');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'user_id', 'user_id');
    }

    public function tickets()
    {
        $this->hasMany(Ticket::class, 'user_id', 'user_id');
    }
}
