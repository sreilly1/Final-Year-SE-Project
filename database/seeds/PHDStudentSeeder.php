<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\User;
use App\Lecturer;
use App\PhdStudent;

class PHDStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	##define("COMSC_EMAIL_DOMAIN", "@cs.cardiff.ac.uk");
    	$phdStudentCSVFile = new CsvFile(__DIR__ . '/_data/phd_student_data.csv');


    	foreach($phdStudentCSVFile as $currentRow) {
    		$user = User::create([
    			'username' => trim($currentRow[0]),
                'password' => Hash::make(trim($currentRow[1])), //hash the password as it is 'plaintext' in the CSV file
                'title' => trim($currentRow[2]),
                'name' => trim($currentRow[3]),
                'email' => str_replace(' ','',$currentRow[3].COMSC_EMAIL_DOMAIN), //replace any spaces in the string
                'phone_number' => trim($currentRow[4]),
                'room_number' => trim($currentRow[5]),
                'role' => 'PHD Student'
            ]);
    		//pick a single random user who is a lecturer to be the supervisor of the PHD student
            $supervisor = User::where('role', '=', 'Lecturer')->get()->random(1);

    		$phdStudent = PhdStudent::create([
    			'user_id' => $user->id,
    			'student_id' => rand (1000000,9999999), #random 7 digit student_id
    			'supervisor_id' => $supervisor->id,
    			'year_of_study' => rand(1,3), //set the current year of study to be a random value between 1 and 3
    			'hours_per_week' => $currentRow[7]
    		]);

    	}
    }
}
