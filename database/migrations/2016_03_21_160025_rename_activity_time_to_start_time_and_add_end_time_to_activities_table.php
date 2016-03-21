<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameActivityTimeToStartTimeAndAddEndTimeToActivitiesTable extends Migration
{

    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //renaming columns in a database table that has 'enum' type fields in it is supposedly not supported by laravel
        //as such the line of code below is used as a workaround, as suggested in :
        //http://stackoverflow.com/questions/29165259/laravel-db-migration-renamecolumn-error-unknown-database-type-enum-requested)
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('activities', function($table) {
            $table->renameColumn('activity_time', 'start_time');
            $table->time('end_time')->before('quant_ppl_needed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function($table) {
            $table->renameColumn('start_time', 'activity_time');
            $table->dropColumn('end_time');
        });
    }
}
