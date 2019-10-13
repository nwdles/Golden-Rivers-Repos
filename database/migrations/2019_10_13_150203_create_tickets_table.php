<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticket_id');
            $table->integer('user_id');
            $table->boolean('ticket_status')->default(false);
            $table->integer('auction_id')->nullable();
            $table->integer('show_id')->nullable();
            $table->text('ticket_comment');

            $table->foreign('user_id')->references('user_id')
                ->on('users');
            $table->foreign('auction_id')->references('auction_id')
                ->on('auctions');
            $table->foreign('show_id')->references('show_id')
                ->on('shows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
