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
                    [
                    'user_login' => 'TheGreatestUser',
                    'user_email' => 'admin@golden-rivers.com',
                    'user_hash_pass' => Hash::make('123456'),
                    'user_phone' => '9066823437',
                    'user_fullname' => 'Главный Юзер Нарайоне',
                    'user_sex' => true,
                    'role_id' => 1,
                    'user_status' => true,
                ],

                [
                    'user_login' => 'first-user',
                    'user_email' => 'first-user@golden-rivers.com',
                    'user_hash_pass' => Hash::make('123456'),
                    'user_phone' => '9008009090',
                    'user_fullname' => 'Первый Юзер Системы',
                    'user_sex' => false,
                    'role_id' => 2,
                    'user_status' => true,
                ],
                [
                    'user_login' => 'second-user',
                    'user_email' => 'second-user@golden-rivers.com',
                    'user_hash_pass' => Hash::make('123456'),
                    'user_phone' => '9008002222',
                    'user_fullname' => 'Второй Юзер Системы',
                    'user_sex' => true,
                    'role_id' => 2,
                    'user_status' => true,
                ],
                [
                    'user_login' => 'third-user',
                    'user_email' => 'third-user@golden-rivers.com',
                    'user_hash_pass' => Hash::make('123456'),
                    'user_phone' => '9008003333',
                    'user_fullname' => 'Третий Юзер Системы',
                    'user_sex' => false,
                    'role_id' => 2,
                    'user_status' => true,
                ],
                [
                    'user_login' => 'fourth-user',
                    'user_email' => 'fourth-user@golden-rivers.com',
                    'user_hash_pass' => Hash::make('123456'),
                    'user_phone' => '9008004444',
                    'user_fullname' => 'Четвертый Юзер Системы',
                    'user_sex' => true,
                    'role_id' => 2,
                    'user_status' => true,
                ]
            ]
            );
    }
}
