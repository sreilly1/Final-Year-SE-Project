<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvFile;
use App\User;
use App\Lecturer;

class LecturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        define("COMSC_EXTENSION_NUMBER_PREFIX", "+44(0)29 208");
        define("COMSC_EMAIL_DOMAIN", "@cs.cardiff.ac.uk");
        //Read in a csv file containing data(username, password, title & name, email, extension number and room number 
        //on the currently members of staff in the school of Computer Science and Informatics) from the _data directory
        $staffCSVFile = new CsvFile(__DIR__ . '/_data/staff.csv');

        //Generate a record using data from each line of the CSV file where each row is in the format: 
        //username, password, title & name, email, extension number, room number
        foreach($staffCSVFile as $currentRow) {

            $parts = explode(' ', $currentRow[2]);
            $user = User::create([
                'username' => trim($currentRow[0]),
                'password' => Hash::make(trim($currentRow[1])),
                'title' => trim($parts[0]),
                'name' => trim(utf8_decode($parts[1].$parts[2])),
                'email' => trim($currentRow[3].COMSC_EMAIL_DOMAIN),
                'phone_number' => trim(COMSC_EXTENSION_NUMBER_PREFIX . $currentRow[4]),
                'room_number' => trim($currentRow[5])
            ]);
            Lecturer::create([
                'user_id' => $user->id
            ]);
        }
    }
}
