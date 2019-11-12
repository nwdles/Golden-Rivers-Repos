<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_login')->unique();
            $table->string('user_email')->unique();
            $table->string('user_hash_pass');
            $table->string('user_phone',10)->unique();
            $table->string('user_fullname');
            $table->boolean('user_sex');
            $table->integer('role_id');
            $table->boolean('user_status')->default(false);
            $table->rememberToken();

            $table->foreign('role_id')->references('role_id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
