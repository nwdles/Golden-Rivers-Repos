<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_items', function (Blueprint $table) {
            $table->increments('show_item_id');
            $table->string('show_item_name',128);
            $table->string('show_item_img')->nullable();
            $table->integer('show_id');
            $table->text('show_item_info');
            $table->date('show_item_date_creation');
            $table->string('show_item_author_fullname');

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
        Schema::dropIfExists('show_items');
    }
}
