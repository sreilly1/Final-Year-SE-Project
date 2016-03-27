<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\Module;
use App\Activity;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//truncate the activities table so that the auto incrementing 'id' field starts counting from 1 again
        DB::table('activities')->truncate();

        //Read in a csv file containing data on some of the activities in the COMSC department 
        $activtiesCSVFile = new CsvFile(__DIR__ . '/_data/Activities.csv');

        //get the 

        //Generate a record using data from each line of the CSV file where each row is in the format: 
        //TODO:put the format here
        //'id' value for each module in the 'modules' table specified in the CSV file, as the module seeder 
        //(and all other seeders including this one) will only be run a single time when it has been put into production


        foreach($activtiesCSVFile as $currentRow) {



            $moduleActivity = Activity::create([
            	'title' => trim($currentRow[0]),
            	'role_type' => trim($currentRow[1]),
            	'module_id' => ($currentRow[2]),
            	'quant_ppl_needed' => $currentRow[3],
            	'knowledge_required' => $currentRow[4]
            ]);
        }
    }
}
