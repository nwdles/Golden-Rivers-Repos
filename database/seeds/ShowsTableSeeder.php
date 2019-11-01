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
                'show_name' => 'Древняя Русь',
                'show_cost_ticket' => 1250,
                'show_date_from' => '2019-11-10',
                'show_date_to' => '2019-11-24',
                'user_id' => 2,
                'show_status' => true,

            ],
            [
                'show_name' => 'Средние века',
                'show_cost_ticket' => 5500,
                'show_date_from' => '2019-11-30',
                'show_date_to' => '2019-11-07',
                'user_id' => 5,
                'show_status' => true,

            ],
            [
                'show_name' => 'Индийская культура',
                'show_cost_ticket' => 750,
                'show_date_from' => '2019-11-01',
                'show_date_to' => '2019-11-14',
                'user_id' => 7,
                'show_status' => false,

            ],
            [
                'show_name' => 'Эпоха возраждения',
                'show_cost_ticket' => 2750,
                'show_date_from' => '2019-12-01',
                'show_date_to' => '2019-12-11',
                'user_id' => 9,
                'show_status' => false,

            ],
            [
                'show_name' => 'Книги старого дома',
                'show_cost_ticket' => 3200,
                'show_date_from' => '2019-11-25',
                'show_date_to' => '2019-12-5',
                'user_id' => 10,
                'show_status' => true,

            ],
        ]);
    }
}
