<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate the modules table so that the auto incrementing 'id' field starts counting from 1 again
        DB::table('modules')->truncate();

        //Read in a csv file containing data(module code, module name, module leader on the currently running modules 
        //in the school of Computer Science and Informatics) from the _data directory
        $modulesCSVFile = new CsvFile(__DIR__ . '/_data/Modules.csv');

        //Generate a record using data from each line of the CSV file where each row is in the format: 
        //module code, module name, module leader, 
		foreach($modulesCSVFile as $currentRow) {
            Module::create([
                'module_code' => trim($currentRow[0]), 
                'module_name' => trim($currentRow[1]),
                'module_leader' => 1
                // code line below is what should actually be used
                //'module_leader' => trim($currentRow[2])
            ]);
        }
    }
}
