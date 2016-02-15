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
            $table->enum('role_type',['Demonstrator', 'Teaching']);
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->integer('staff_1')->unsigned();
            $table->foreign('staff_1')->references('id')->on('lecturers');
            $table->dateTime('activity_date');
            $table->string('Weeks');
            $table->integer('from_hour');
            $table->enum('am_pm',['AM', 'PM']);
            $table->integer('to_hour');
            $table->enum('am_pm_2',['AM', 'PM']);
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
