<?php

use Illuminate\Database\Seeder;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shows')->insert([
            [
                'show_name' => 'Что-то про древнюю Русь',
                'show_cost_ticket' => 1250,
                'show_date_from' => '10.11.2019',
                'show_date_to' => '24.11.2019',
                'user_id' => 3,
                'show_status' => false,

            ],
            [
                'show_name' => 'Что-то про средние века',
                'show_cost_ticket' => 5500,
                'show_date_from' => '31.10.2019',
                'show_date_to' => '7.11.2019',
                'user_id' => 1,
                'show_status' => true,

            ],
            [
                'show_name' => 'Что-то про индийскую культуру',
                'show_cost_ticket' => 750,
                'show_date_from' => '1.11.2019',
                'show_date_to' => '14.11.2019',
                'user_id' => 2,
                'show_status' => false,

            ],
            [
                'show_name' => 'Что-то про эпоху возраждения',
                'show_cost_ticket' => 2750,
                'show_date_from' => '1.12.2019',
                'show_date_to' => '11.12.2019',
                'user_id' => 1,
                'show_status' => true,

            ],
        ]);
    }
}
