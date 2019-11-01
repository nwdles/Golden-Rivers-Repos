<?php

use Illuminate\Database\Seeder;

class AuctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auctions')->insert([
            [
                'auction_name' => 'Древнерусская одежда',
                'auction_cost_ticket' => 5000,
                'auction_date' => '2019-11-15',
                'user_id' => 13,
                'auction_status' => false,

            ],
            [
                'auction_name' => 'Древнегреческие украшения',
                'auction_cost_ticket' => 3400,
                'auction_date' => '2019-11-3',
                'user_id' => 16,
                'auction_status' => true,

            ],
            [
                'auction_name' => 'Револьверы Великобритании',
                'auction_cost_ticket' => 7950,
                'auction_date' => '2019-11-22',
                'user_id' => 19,
                'auction_status' => true,

            ],
            [
                'auction_name' => 'Старинные картины',
                'auction_cost_ticket' => 10500,
                'auction_date' => '2019-12-01',
                'user_id' => 2,
                'auction_status' => true,

            ],
            [
                'auction_name' => 'Граммофон',
                'auction_cost_ticket' => 2300,
                'auction_date' => '2019-12-20',
                'user_id' => 10,
                'auction_status' => false,

            ],
        ]);
    }
}
