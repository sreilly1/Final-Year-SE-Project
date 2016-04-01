<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\ActivityRequest;
use App\User;

class IntuitiveAssignmentController extends Controller
{
	public function performIntuitiveAssignment() {
		
		$activities = Activity::all();

		//create an ass0ciative array representing the am0unt 0f succesful applicatins
		//there has been f0r each supp0rt activity, where the key is the activity's primary key 
		//in the database, and the value is the number 0f succesful applicati0ns.
		$activityApplicationTally = array();
		foreach($activities as $activity) {	
			//c0unt the number 0f succesful applicati0ns f0r the activity
			$numSuccesfulApplicants = $activity->getSuccessfulApplications->count();

			//it is imp0ssible t0 intuitively assign phd students t0 the activity
			//if the activity has had n0 succesful applicants, theref0re 0nly activities
			//which have at least 1 succesful applicati0n will be added t0 the ass0ciative array
			if ($numSuccesfulApplicants > 0 ) {
				$activityApplicationTally[$activity->id] = $numSuccesfulApplicants;
			}

		}
		//fr0m http://www.w3schools.com/php/func_array_asort.asp
		//s0rt the ass0ciative array s0 that the activities with the fewest number 0f sucessful
		//applicants will be pr0cessed first.
		asort($activityApplicationTally, SORT_NUMERIC); 

		//pr0cess the activties in the assci0ative array 1 by 1.

		$assignmentsMade = array(); //Ass0ciative array where key is the PHD student's ID in the database and
		//the value is the id 0f the activity t0 which they were assigned
		foreach($activityApplicationTally as $activityID => $numSuccesfulApplicants) {
			
			$numTutorsRequired = Activity::find($activityID)->quant_ppl_needed;

			if($numSuccesfulApplicants == $numTutorsRequired) {
				$activity = Activity::find($activityID);
				$successfulApplications = $activity->getSuccessfulApplications;
				//assign the succesful applicants t0 all sessi0ns f0r the activity
				foreach($successfulApplications as $successfulApplication) {

					$phdStudent = User::find($successfulApplication->user_id);;

					//line bel0w fr0m here https://laravel.com/docs/master/collections#method-pluck, why d0es this w0rk?
					$phdStudentSessions = $phdStudent->sessions()->attach($activity->sessions->pluck('id')->all());
					$assignmentsMade[$phdStudent->name] = $activity->title;
				}
			}
		}
		//foreach($assignments as $assignment) {
			//var_dump($assignment);
		//}
		return view('intuitiveAssignmentResults')->with('assignmentsMade',$assignmentsMade);
		//var_dump( $assignments); 
		//var_dump($phdStudentSessions);
		//return  $phdStudentSessions;
    }
}
//Discuss ab0ut clashes with Helen, as they C0ULD be hard t0 handle pr0gramatically. Presumably PHD students w0uld be able t0 see when a lab class is 0N
//bring up AB0UT this in the rep0rt