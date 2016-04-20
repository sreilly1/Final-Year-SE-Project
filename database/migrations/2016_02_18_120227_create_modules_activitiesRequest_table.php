<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesActivitiesRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_request', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('modules_activities');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('supervisor_comment');
            $table->enum('supervisor_confirmation',['Pending', 'Confirmed', 'Declined']);
            $table->enum('status',['Pending', 'Accepted', 'Declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities_request');
    }
}
