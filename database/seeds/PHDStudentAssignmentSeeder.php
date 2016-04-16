<?php

use Illuminate\Database\Seeder;
use App\jobRequest;
use App\User;
use App\Activity;

class PHDStudentAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //get the first PHD student whose name is 'Alicia Reid'
		$phdStudent = User::where('name','=','Alicia Reid')->first();

        //get the first job whose 'title' is 'CM1103 Python Programming Lab'
    	$supportActivity = Activity::where('title','=','CM1103 Python Programming Lab')
        ->first();

        /*
            assign the PHD student to all the sessions for the 'CM1103 Python Programming Lab' job
            (5 sessions of two hours each as is produced by the 'SessionsSeeder' class) by inserting an
            entry in the pivot table as shown in 
            https://laravel.com/docs/5.2/eloquent-relationships#inserting-many-to-many-relationships
        */
        $assignments = $phdStudent->sessions()->attach($supportActivity->sessions->pluck('id')->all());


        //get the first job whose 'title' is 'CM1103 Discrete Maths Tutorial'
        $supportActivity = Activity::where('title','=','CM1103 Discrete Maths Tutorial')
        ->first();

        /*
            assign the PHD student to all the sessions for the 'CM1103 Python Programming Lab' job
            (5 sessions of two hours each as is produced by the 'SessionsSeeder' class) by inserting an
            entry in the pivot table as shown in 
            https://laravel.com/docs/5.2/eloquent-relationships#inserting-many-to-many-relationships
        */
        $assignments = $phdStudent->sessions()->attach($supportActivity->sessions->pluck('id')->all());

    }
}
