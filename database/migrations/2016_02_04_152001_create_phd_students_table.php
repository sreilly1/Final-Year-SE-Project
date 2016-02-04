<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhdStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phd_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('student_id');
            $table->string('supervisor_name');
            $table->string('year_of_study');
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
        Schema::drop('phd_students');
    }
}
