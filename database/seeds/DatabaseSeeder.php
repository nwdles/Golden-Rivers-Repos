<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ShowsTableSeeder::class);
         $this->call(AuctionsTableSeeder::class);
         $this->call(TicketsTableSeeder::class);
         $this->call(ShowItemsTableSeeder::class);
         $this->call(AuctionItemsTableSeeder::class);
    }
}
