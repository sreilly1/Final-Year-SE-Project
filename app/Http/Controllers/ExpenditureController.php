<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use App\Module;

class ExpenditureController extends Controller
{
    /**
	 * Finds all sessi0ns that a PHD student with a given 'id' in the database
     * undert00k within a given date range (expresssed by the 'fromDate' and 'toDate' parameters)
     * and calculates the resulting c0st/expenditure/payment.
	 *
	 * @param  int  $id, date $fromDate, date $toDate T0D0: replace 'date' with the actual type
	 * @return Response
	 */
    public function calculatePHDStudentExpenditure($id,$fromDate,$toDate) {
        //retrieve the PHD student via their primary key in the 'Users' table
        $phdStudent = User::find($id);

        //0btain all sessi0ns relating t0 the supp0rt activities that the PHD student has been assigned which
        //fall within the date range signified by fr0mDate and t0Date, in ascending 0rder 0f the the date 0f the sessi0ns
        $sessions = $phdStudent->sessions()->whereBetween('date_of_session',array($fromDate,$toDate))->orderBy('date_of_session')->get();
        $totalHoursWorked = 0;
        $totalExpenditure = 0;
        $demonstratorHours = 0;
        $teachingHours = 0;

        foreach ($sessions as $session) {
            $startTime = new Carbon($session->start_time); //http://carbon.nesbot.com/docs/#api-humandiff maybe use phpdatetime instead
            $endTime = new Carbon($session->end_time); //http://carbon.nesbot.com/docs/#api-humandiff
            $sessionDuration = $startTime->diffInHours($endTime); //http://carbon.nesbot.com/docs/#api-humandiff
            $totalHoursWorked += $sessionDuration;
            $role = $session->activity->role_type;//the 'role' the PHD student was for the given 'session'

            if($role == 'Demonstrator') {
                $payRate = 9.00;
                $demonstratorHours += $sessionDuration;
            } elseif ($role = 'Teaching') {
                $payRate = 8.00;
                $teachingHours += $sessionDuration;
            }
            $totalExpenditure += $sessionDuration * $payRate;

        }
        return view('calculatePHDStudentExpenditureResults')->with([
            'sessions' => $sessions, 
            'totalExpenditure'  => $totalExpenditure, 
            'phdStudent'        => $phdStudent, 
            'demonstratorHours' =>  $demonstratorHours,
            'teachingHours'     =>   $teachingHours
            ]);
    }

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
                $payRate = 9.00;
            } elseif ($role = 'Teaching') {
                $payRate = 8.00;
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