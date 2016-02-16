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
        $modulesCSVFile = new CsvFile(__DIR__ . '/_data/book2.csv');

		foreach($modulesCSVFile as $currentRow) {
            Module::create(['module_code' => $currentRow[0], 'module_name' => $currentRow[1]]);
        }
    }
}
