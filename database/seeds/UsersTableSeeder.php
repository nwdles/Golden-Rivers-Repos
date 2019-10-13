<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_login' => 'TheGreatestUser',
            'user_email' => 'admin@golden-rivers.com',
            'user_hash_pass' => Hash::make('123456'),
            'user_phone' => '9066823437',
            'user_fullname' => 'Главный Юзер Нарайоне',
            'user_sex' => true,
            'role_id' => 1,
            'user_status' => true,
        ]);
    }
}
