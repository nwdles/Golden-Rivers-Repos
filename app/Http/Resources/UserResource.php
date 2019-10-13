<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_login' => $this->user_login,
            'user_fullname' => $this->user_fullname,
            'user_status' => $this->user_status,
            'user_email' => $this->user_email,
            'user_phone' => $this->user_phone,
            'user_sex' => $this->user_sex,
            'role' => $this->role
        ];
    }
}
