<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('show_id');
            $table->string('show_name');
            $table->string('show_full_img')->nullable();
            $table->string('show_short_img')->nullable();
            $table->double('show_cost_ticket');
            $table->date('show_date_from');
            $table->date('show_date_to');
            $table->integer('user_id');
            $table->boolean('show_status')->default(false);

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
        Schema::dropIfExists('shows');
    }
}
