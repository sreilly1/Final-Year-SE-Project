<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use App\Module;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
	 * Calculates the payment a PHD student was due from a given date range 
	 * (expresssed by the 'fromDate' and 'toDate' parameters) and returns other relevant
	 * details such as the sessions they undertook in that date range and the number
	 * of hours they worked as a demonstrator, similarly with the role 'teaching'
     * 
	 *
	 * @param  int  $id, string $fromDate, string $toDate
	 * @return view
	 */
    public function calculatePHDStudentPayment($id,$fromDate,$toDate) {

        $errors = $this->checkDateRangeValidity($fromDate, $toDate);

        if (empty($errors)) {
            
            //retrieve the PHD student via their primary key in the 'Users' table (using the id passed to this function)
            $phdStudent = User::find($id);
            /*
                query the 'sessions' relationship (which is a many-to-many relationship, see 
                'https://laravel.com/docs/5.2/eloquent-relationships#many-to-many'for more information about using and specifying
                many-to-many relationship) specified in the 'User' model (which is located at App\User.php) to get the sessions
                to which the PHD student was allocated and reduce the sessions to those that occur between the 'fromDate' and 'toDate'
                parameters and order them chronologically. For use of WhereBetween see 'https://laravel.com/docs/5.2/queries#where-clauses'
            */
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


                /*
                    Work out what role the PHD student undertook for the session
                    by querying the session's activity relationship to work out 
                    what the parent support activity is for the session
                    i.e. what support activity the sesion relates to then grab
                    the value of the 'role_type' field of the support activity
                */
                $role = $session->activity->role_type; 

                //determine the payrate from the 'role' type of the job
                if($role == 'Demonstrator') {
                    $payRate = 9.00;
                    $demonstratorHours += $sessionDuration;
                } elseif ($role = 'Teaching') {
                    $payRate = 8.00;
                    $teachingHours += $sessionDuration;
                }
                $totalExpenditure += $sessionDuration * $payRate;

            }
            /*
                return the calculatePHDStudentExpenditureResult.blade.php file
                which is located under (resources\views) and pass it the variables:
                    $sessions
                    $totalExpenditure
                    $phdStudent
                    $demonstratorHours
                    $teachingHours
                each variable in the view can then be referenced by the same name
                as per the example given at 'https://laravel.com/docs/5.2/views'
            */
            return view('calculatePHDStudentExpenditureResults')->with([
                'sessions' => $sessions, 
                'totalExpenditure'  => $totalExpenditure, 
                'phdStudent'        => $phdStudent, 
                'demonstratorHours' =>  $demonstratorHours,
                'teachingHours'     =>   $teachingHours
                ]);
        } else {
            return Redirect::back()->withErrors($errors); 
        } 
    }

    //checks that the supplied date range is valid, i.e. 'fromDate' comes before 'toDate' chronologically
    public function checkDateRangeValidity($fromDate,$toDate) {
        $fromDate = new Carbon($fromDate);
        $toDate = new Carbon($toDate);

        $errors = array();
        if($fromDate->gt($toDate)) {
            array_push($errors, "the date range entered is invalid, please make sure the 'from' date is later than the 'to' date");
            print "ayee";
        }
        return $errors;
    }
}
