<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('role_type',['Demonstrator', 'Teaching']);
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->integer('staff_1')->unsigned();
            $table->foreign('staff_1')->references('id')->on('users');
            $table->date('activity_date');
            $table->time('activity_time');
            $table->integer('quant_ppl_needed');
            $table->string('location');
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
        Schema::drop('modules_activities');
    }
}
