<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('auction_id');
            $table->string('auction_name');
            $table->string('auction_full_img')->nullable();
            $table->string('auction_short_img')->nullable();
            $table->double('auction_cost_ticket');
            $table->date('auction_date');
            $table->integer('user_id');
            $table->boolean('auction_status')->default(false);

            $table->foreign('user_id')->references('user_id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
