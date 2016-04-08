<?php

use Illuminate\Database\Seeder;
use App\Session;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//truncate the activities table so that the auto incrementing 'id' field starts counting from 1 again
        DB::table('sessions')->truncate();

        $activtiesCSVFile = new CsvFile(__DIR__ . '/_data/Sessions.csv');

    	$supportActivity = Activity::where('title','=','CM1103 Python Programming Lab')->first();

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
