<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_items', function (Blueprint $table) {
            $table->increments('auction_item_id');
            $table->string('auction_item_name',128);
            $table->string('auction_item_img')->nullable();
            $table->integer('auction_id');
            $table->text('auction_item_info');
            $table->double('auction_item_cost');

            $table->foreign('auction_id')->references('auction_id')
                ->on('auctions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_items');
    }
}
