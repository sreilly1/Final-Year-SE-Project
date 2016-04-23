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
            $table->integer('module_id')->unsigned()->nullable();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->integer('quant_ppl_needed');
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