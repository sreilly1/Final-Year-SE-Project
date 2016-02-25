<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ModulesActivity;
use App\ActivityRequest;

class IntuitiveAssignmentController extends Controller
{
	public function performIntuitiveAssignment() {
	    	
			//work out the number of applications for each activity
			$moduleActivities = ModulesActivity::All();
			$arr = array();
			//$activityRequests =  ActivityRequest::where('activity_id', '=', $activity->id)->get();
			foreach($moduleActivities as $activity) {
				$arr[$activity->id] = ActivityRequest::where('activity_id', '=', $activity->id)->count();
				//$activityRequests =  ActivityRequest::where('activity_id', '=', $activity->id)->t();//
				return $arr;
				//return $activityRequests;
			}
    }
}