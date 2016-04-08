<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\Session;
use App\Activity;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     * As a result of this database seeder script, 4 sessions will be created for the 
     * 'CM1103 Python Programming Lab' support activity, for which a single 
     * Demonstrator' role is assumed to be required
     *
     * @return void
     */
    public function run()
    {
    	//truncate the activities table so that the auto incrementing 'id' field starts counting from 1 again
        DB::table('sessions')->truncate();

        $activtiesCSVFile = new CsvFile(__DIR__ . '/_data/SessionsData.csv');

        //maybe make it w0rth with get(); s0meh0w
    	$supportActivity = Activity::where('title','=','CM1103 Python Programming Lab')->where('role_type','=', 'Demonstrator')->first();

    	foreach($activtiesCSVFile as $currentRow) {

		    $Session = Session::create([
		    	'activity_id' => $supportActivity->id,
		    	'date_of_session' => trim($currentRow[0]),
				'start_time' => trim($currentRow[1]),
				'end_time' => trim($currentRow[2]),
				'location' => trim($currentRow[3]),
		    ]);
		}
    }
}
