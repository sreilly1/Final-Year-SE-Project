<?php

use Illuminate\Database\Seeder;
use App\ActivityRequest;
use App\User;


class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Get the PHD student from the database whose 'id' field is 55.
    	//As the seeder for creating user is ran first this user will always exist so error checking
    	//isn't required. This code automatically assumes that the PHD student has applied for the 
    	//'CM1103 Python Programming Lab' support activity and has been accepted for the role + has been
    	//assigned to it (this support activity will already exist in the database before this code is ran.
    	//the phd student is then assigned to all session (i.e. all combinations of a start time, end time and date) 
		//for the 'CM1103 Python Programming Lab' 
		$phdStudent = User::find(55);
    	$supportActivity = Activity::where('title','=','CM1103 Python Programming Lab')->first();
        $assignments = $phdStudent->sessions()->attach($supportActivity->sessions->pluck('id')->all());
    }
}
