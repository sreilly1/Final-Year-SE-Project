<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\ModulesActivity;

class ModulesActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Read in a csv file containing data on fake activities in the COMSC department 
        $moduleActivtiesCSVFile = new CsvFile(__DIR__ . '/_data/activities.csv');

        //Generate a record using data from each line of the CSV file where each row is in the format: 
        //module id,staff 1,activity date, weeks, from hour, am_pm, to_hour, am_pm_2, quant_ppl_needed, location
        foreach($moduleActivtiesCSVFile as $currentRow) {

            $moduleActivity = ModulesActivity::create([
            	'role_type' => trim($currentRow[0]),
                'module_id' => trim($currentRow[1]),
                'staff_1' => trim($currentRow[2]),
                'activity_date' => trim($currentRow[3]),
                'activity_time' => trim($currentRow[4]),
                'quant_ppl_needed' => trim($currentRow[5]),
                'location' => trim($currentRow[6]),
            ]);
        }
    }
}
