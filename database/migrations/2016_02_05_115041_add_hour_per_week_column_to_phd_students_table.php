<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHourPerWeekColumnToPhdStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phd_students', function ($table) {
            //default value set to 0
            $table->integer('hours_per_week')->default(0)->after('year_of_study'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phd_students', function ($table) {
            $table->dropColumn('hours_per_week');
        });
    }
}
