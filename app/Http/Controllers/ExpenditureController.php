<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;

class ExpenditureController extends Controller
{
    /**
	 * Finds all sessi0ns that a PHD student with a given 'id' in the database
     * undert00k within a given date range (expresssed by the 'fromDate' and 'toDate' parameters)
	 *
	 * @param  int  $id, date $fromDate, date $toDate T0D0: replace 'date' with the actual type
	 * @return Response T0D0: replace 'Resp0nse' with what is actually returned
	 */
    public function calculatePHDStudentExpenditure($id,$fromDate,$toDate) {
        //retrieve the PHD student via their primary key in the 'Users' table
        $phdStudent = User::find($id);

        //0btain the sessi0ns that the PHD student has been assigned t0
        $sessions = $phdStudent->sessions()->orderBy('date_of_session')->get();
        $totalHoursWorked = 0;

        foreach ($sessions as $session) {
            $startTime = new Carbon($session->start_time); //http://carbon.nesbot.com/docs/#api-humandiff
            $endTime = new Carbon($session->end_time); //http://carbon.nesbot.com/docs/#api-humandiff
            $totalHoursWorked += $startTime->diffInHours($endTime); 
        }

        $totalExpenditure = $totalHoursWorked * 8; //8 is the assumed payrate in £/hr
        return view('calculatePHDStudentExpenditureResults')->with(['sessions' => $sessions, 'totalExpenditure' => $totalExpenditure, 'phdStudent' => $phdStudent, 'totalHoursWorked' =>$totalHoursWorked]);
    }
}