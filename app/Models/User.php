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

    public function findForPassport($username) {
        return self::where('user_login', $username)->first();
    }

    public function getAuthPassword()
    {
        return $this->user_hash_pass;
    }
}
