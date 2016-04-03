<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned();
            $table->integer('user_id')->unsigned();

            //when a particular row from the 'sessions' table is deleted
            //the corresponding record in the session_user table will be deleted
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');

            //when a particular row from the 'users' table is deleted
            //the corresponding record in the session_user table will be deleted
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('session_user');
    }
}
