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

        foreach ($sessions as $session) {
            $startTime = new Carbon($session->start_time); //http://carbon.nesbot.com/docs/#api-humandiff
            $endTime = new Carbon($session->end_time); //http://carbon.nesbot.com/docs/#api-humandiff
            $totalHoursWorked += $startTime->diffInHours($endTime); //http://carbon.nesbot.com/docs/#api-humandiff
        }

        $totalExpenditure = $totalHoursWorked * 8; //8 is the assumed payrate in £/hr
       
        return view('calculatePHDStudentExpenditureResults')->with([
            'sessions' => $sessions, 
            'totalExpenditure' => $totalExpenditure, 
            'phdStudent' => $phdStudent, 
            'totalHoursWorked' =>$totalHoursWorked
        ]);
    }

    public function calculateModuleExpenditure($id,$fromDate,$toDate) {
        $module = Module::find($id);
        $activities = $module->activities;
        $activityCosts = array();
        $totalModuleCost =0;
        $payrate = 8.00;

        foreach ($activities as $activity) {
            $sessions = $activity->sessions()->whereBetween('date_of_session',array($fromDate,$toDate))->orderBy('date_of_session')->get();
            $totalHoursPerPerson = 0;
            foreach ($sessions as $session) {
                $startTime = new Carbon($session->start_time); //http://carbon.nesbot.com/docs/#api-humandiff
                $endTime = new Carbon($session->end_time); //http://carbon.nesbot.com/docs/#api-humandiff
                $totalHoursPerPerson += $startTime->diffInHours($endTime); //http://carbon.nesbot.com/docs/#api-humandiff         
            }
            if(array_key_exists($activity->title, $activityCosts)){
                $activityCosts[$activity->title] += ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payrate;
            } else {
                $activityCosts[$activity->title] = ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payrate; //this 0verwrites 0ld values2d
            }
            //$activityCosts[$activity->id] = ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payrate; //this 0verwrites 0ld values
            $totalModuleCost += ($totalHoursPerPerson * $activity->quant_ppl_needed) * $payrate;
        }
        return view('calculateModuleExpenditureResults')->with([
            'module' => $module,
            'totalModuleCost' =>$totalModuleCost,
            'activityCosts' => $activityCosts
        ]);
    }   

}