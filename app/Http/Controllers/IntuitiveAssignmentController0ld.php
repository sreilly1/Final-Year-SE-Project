<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\ActivityRequest;

class IntuitiveAssignmentController extends Controller
{
	public function performIntuitiveAssignment() {
		//Grab all the activities
		$activities = Activity::all();

		//pr0duce a tally 0f h0w many succesful applicati0ns each activity has received, 
		//in the f0rm 0f an ass0ciative array f0r th0se activities which have received
		//m0re than 0 applicati0ns
		$activityApplicationTally = array();
		foreach($activities as $activity) {	
			//get a c0unt 0f the number 0f succesful applicants f0r this activity
			$numSuccesfulApplicants = $activity->getSuccessfulApplications->count();
			if ($numSuccesfulApplicants > 0 ) {
				$activityApplicationTally[$activity->id] = $numSuccesfulApplicants;
			}

		}
		//fr0m http://www.w3schools.com/php/func_array_asort.asp
		asort($activityApplicationTally, SORT_NUMERIC);

		foreach($activityApplicationTally as $activityID => $numSuccesfulApplicants) {
			$numTutorsRequired = Activity::find($activityID)->quant_ppl_needed;
			echo $numTutorsRequired;


			//var_dump($activity);
		}

		//return $activityApplicationTally;





		//return Activity::with('activityRequests');
    }
}