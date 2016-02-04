<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_Types', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('user_type', ['phd_Student', 'lecturer', 'admin']);
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
        Schema::drop('user_Types');
    }
}
