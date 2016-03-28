<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\Module;
use App\Activity;


use Symfony\Component\Console\Output\ConsoleOutput;

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
        // $output = new ConsoleOutput();
        // $modules = Module::all();
        // $output->writeln((string)$modules);

        //Generate a record using data from each line of the CSV file where each row is in the format: 
        //TODO:put the format here
        //'id' value for each module in the 'modules' table specified in the CSV file, as the module seeder 
        //(and all other seeders including this one) will only be run a single time when it has been put into production


        foreach($activtiesCSVFile as $currentRow) {

            //get an object representing the first module whose module code matches the one in the row
            //of the CSV file that is currently being processed. The first method returns only the first match
            //as the modules in the database should have unique module codes anyway.
            $module = Module::where('module_code','=', (string)$currentRow[2])->first();
            $output = new ConsoleOutput();
            $output->writeln((string) $module);

            //access the 'id' field (primary key) of module received by the previous query
            //$moduleId = $module->id;

            $moduleActivity = Activity::create([
            	'title' => trim($currentRow[0]),
            	'role_type' => trim($currentRow[1]),
            	'module_id' => $module->id,
                'staff_1' => $currentRow[3],
            	'quant_ppl_needed' => $currentRow[4],
                'closing_date_for_applications' => $currentRow[5],
            	'knowledge_required' => $currentRow[6]
            ]);
        }
    }
}


//f0rmat in csv file: title   role type   m0dule  staff 1 quant ppl needed    cl0sing date f0r applicati0ns (in yyyy-dd-mm f0rmat/american)    kn0wledge required


//T0D0:Make this wrk with inductin activities (there is a csv file f0r this)