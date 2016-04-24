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
     * Show the form for allowing the system administrator
     * to choose the PhD student to calculate the payment for
     * and selecting the date range which the payment should 
     * relate to.
     *
     * @return view
     */
    public function showCalculatePHDStudentPayForm() {
        
        /*
            get all the PhD students from the database and order
            them by the 'name' field (by their firstname)
        */
        $phdStudents = User::where('role', '=', 'PHD Student')
        ->orderBy('name')
        ->get();

        
        return view('calculatePHDStudentPayForm')->with([
            'phdStudents' => $phdStudents
        ]);
    }

    /**
	 * Calculates the payment a PHD student was due from a given date range 
	 * (expresssed by the 'fromDate' and 'toDate' parameters) and returns other relevant
	 * details such as the sessions they undertook in that date range and the number
	 * of hours they worked as a demonstrator, similarly with the role 'teaching'.
     * 
	 * @param  int  $id, string $fromDate, string $toDate
	 * @return view
	 */
    public function calculatePHDStudentPayment($id,$fromDate,$toDate) {

        /*
            retrieve the PHD student via their primary key in the 'Users' table 
            (using the id passed to this function)
        */
        $phdStudent = User::find($id);

        $errors = $this->checkForErrors($phdStudent, $fromDate, $toDate);

        if ( empty($errors) ) {

            

            /*
                check that the value of $id matches the 'id' field of a record in the users table
                and if it doesn't then return the calculatePHDStudentExpenditureResult.blade.php file
                which is located under (resources\views) and pass it the variable.
                $error which can be reference as $error in the blade file 
            */
               
            /*
                query the 'sessions' relationship (which is a many-to-many relationship, see 
                'https://laravel.com/docs/5.2/eloquent-relationships#many-to-many'
                for more information about using and specifying many-to-many relationship) 
                specified in the 'User' model (which is located at App\User.php) to get 
                the sessions to which the PHD student was allocated and reduce 
                the sessions to those that occur between the 'fromDate' and 'toDate'
                parameters and order them chronologically. 
                For use of WhereBetween see 'https://laravel.com/docs/5.2/queries#where-clauses'.
            */
                $sessions = $phdStudent->sessions()->whereBetween('date_of_session',array($fromDate,$toDate))
                ->orderBy('date_of_session')
                ->get();

                $hoursWorkedToRoleMapping = $this->getRoleToHoursWorkedMapping($sessions);

                $totalHoursWorked = 0;
                $totalPayment = 0.00;

            /*
                increment the total payment by the number of hours that were worked 
                as a 'demonstrator' multiplied by the assumed payrate. Similarly
                with the number of hours worked under the 'Teaching' role.
            */
                $demonstratorHours = $hoursWorkedToRoleMapping['Demonstrator'];
                $totalPayment +=  $demonstratorHours * 12.21;
                $teachingHours = $hoursWorkedToRoleMapping['Teaching'];
                $totalPayment += $teachingHours * 10.58;

            /*
                return the calculatePHDStudentExpenditureResult.blade.php file
                which is located under (resources\views) and pass it the variables:
                    $sessions,
                    $totalPayment,
                    $phdStudent,
                    $demonstratorHours,
                    $teachingHours,
                each variable in the view can then be referenced by the same name
                as per the example given at 'https://laravel.com/docs/5.2/views'.
            */
            return view('calculatePHDPaymentResults')->with([
                'sessions'                 => $sessions, 
                'totalPayment'             => $totalPayment, 
                'phdStudent'               => $phdStudent, 
                'demonstratorHours'        => $demonstratorHours,
                'teachingHours'            => $teachingHours,
            ]);
        } else {
            /*
                get all the PhD students from the database and order
                them by the 'name' field (by their firstname)
            */
            $phdStudents = User::where('role', '=', 'PHD Student')
            ->orderBy('name')
            ->get();
            return view('calculatePHDStudentPayForm')->with([
                'error'       => $errors,
                'phdStudents' => $phdStudents 
            ]);
        }
    }

    /**
     * Takes a laravel collection (see https://laravel.com/docs/5.2/collections) 
     * of Session instances (instances of the 'Session' model) and returns
     * a mapping (an associative array ) where each key represents a role
     * that a PHD student may undertake for a session and each key
     * represents the number of hours that are related to that role
     * for the sessions passed to the function.
     * 
     * @param collection $sessions
     * @return [] $hoursWorkedMapping
     */
    public function getRoleToHoursWorkedMapping($sessions) {

        $hoursWorkedMapping = array(
            'Demonstrator' => 0,
            'Teaching' => 0
            );

        foreach ($sessions as $session) {
            $startTime = new Carbon($session->start_time);
            $endTime = new Carbon($session->end_time); 
            $sessionDuration = $startTime->diffInHours($endTime);
            /*
                Work out what role the PHD student undertook for the session
                by querying the session's activity relationship to work out 
                what the parent support activity is for the session
                i.e. what support activity the sesion relates to then grab
                the value of the 'role_type' field of the support activity.
            */
                $role = $session->activity->role_type;
                $hoursWorkedMapping[$role] += $sessionDuration;

        }
        return $hoursWorkedMapping;
    }

    /**
     * Checks the validity of the provided input
     * 
     * @param  obj $phdStudent, string $fromDate, string $toDate
     * @return [] $errors
     */
    public function checkForErrors ($phdStudent,$fromDate, $toDate) {

        $errors = array();

        //check that $fromDate appears before $toDate chronologically
        if(strtotime($fromDate) > strtotime($toDate)) {
            $dateError= 'Please make sure the from date is earlier than the to date.';
            array_push($errors, $dateError);
        }

        /*
            if $phdStudent is null then a user whose id matches the one passed to the
            'calculatePHDStudentPayment' does not exist
        */
        if ($phdStudent == null ) {
            $phdStudentError = 'The PHD student that you specified does not exist.';
            array_push($errors, $phdStudentError);
        }

        /*
            check the $fromDate and $toDate parameters are in the format yyyy-mm-dd
        */ 
        if (DateTime::createFromFormat('Y-m-d', $fromDate) == false
            || (DateTime::createFromFormat('Y-m-d', $toDate) == false)) {
            $missingDateError = "Please ensure that you provide a 'from' and a 'to' date.";
            array_push($errors, $missingDateError);
        }
        return $errors;

    }
}
