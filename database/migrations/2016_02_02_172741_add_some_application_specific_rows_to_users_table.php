<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//add this migrations things to the create_users_table migration

class AddSomeApplicationSpecificRowsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('supervisor_name');
            $table->string('phone_number');
            $table->integer('year_of_study');
            $table->integer('student_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('supervisor_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('year_of_study');
            $table->dropColumn('student_id');

        });
    }
}
