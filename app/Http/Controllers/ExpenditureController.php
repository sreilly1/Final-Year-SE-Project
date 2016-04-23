<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use App\Module;
use Illuminate\Support\Facades\Redirect;

class ExpenditureController extends Controller
{

    public function calculateModuleExpenditure($id,$fromDate,$toDate) {
        $module = Module::find($id);
        $activities = $module->activities;
        $activityCosts = array();
        $totalModuleCost =0;
        foreach ($activities as $activity) {
            $sessions = $activity->sessions()->whereBetween('date_of_session',array($fromDate,$toDate))->orderBy('date_of_session')->get();
            $totalHoursPerPerson = 0;
            $activityTitle = $activity->title;
            $role = $activity->role_type;//the 'role' the PHD student was for the given 'session'

            if($role == 'Demonstrator') {
                $payRate = 12.21;
            } elseif ($role = 'Teaching') {
                $payRate = 10.58;
            }
            foreach ($sessions as $session) {
                $startTime = new Carbon($session->start_time); //http://carbon.nesbot.com/docs/#api-humandiff
                $endTime = new Carbon($session->end_time); //http://carbon.nesbot.com/docs/#api-humandiff
                $totalHoursPerPerson += $startTime->diffInHours($endTime); //http://carbon.nesbot.com/docs/#api-humandiff         
            }
            if(array_key_exists($activityTitle, $activityCosts)){
                $activityCosts[$activityTitle] += ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payRate;
            } else {
                $activityCosts[$activityTitle] = ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payRate; //this 0verwrites 0ld values2d
            }
            $totalModuleCost += ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payRate;
        }
        return view('calculateModuleExpenditureResults')->with([
            'module' => $module,
            'totalModuleCost'   =>$totalModuleCost,
            'activityCosts'     => $activityCosts
            ]);
    }   



}