<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class PaymentControllerTest extends TestCase
{

    /**
     * Test a call to  the 'CalculationOfPHDStudentPayment' function of the 
     * PaymentController, providing a valid date range and a valid 'id' field 
     * value for the users table
     */
    /** @test */
    public function testCalculationOfPHDStudentPaymentSucceeds() {

        //get the first PHD student whose name is 'Alicia Reid'
        $phdStudent = User::where('name','=','Alicia Reid')->first();

        /*
            call the 'calculatePHDStudentPayment' function of the 'PaymentController'
            and set the value of the 'id' parameter to be the ID of the PHD student
            and set the value of the 'fromDate' parameter in YYYY-MM-DD format 
            (which the controller expect due to the way the dates are stored in the 
            database) to '2016-10-01' and the value of the 'toDate' parameter to
            '2016-11-10'
        */
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => $phdStudent->id,
            'fromDate' =>'2016-10-01',
            'toDate' => '2016-11-10'
        ));

        /*
            get the view returned from calling the 'calculatePHDStudentPayment'
            of the 'PaymentController'
        */
    	$view = $response->original;

        /*
            assert that the value of the 'totalPayment' variable c0ntained
            in the view has a value of 227.9
        */
    	$this->assertEquals(227.9, $view['totalPayment']);


        /*
            assert that the value of the 'demonstratorHours' variable c0ntained
            in the view has a value of 10
        */
    	$this->assertEquals(10, $view['demonstratorHours']);

        /*
            assert that the value of the 'teachingHours' variable c0ntained
            in the view has a value of 10
        */
    	$this->assertEquals(10, $view['teachingHours']);

        /*
            the finding of the phd student from the id depends purely upon built in 
            laravel methods which will have been tested by the developers and
            as such there is no reason to test the right phd student has been sent
            to the view. The same concept applies to querying the 'sessions' 
            relationship of the PHD student/User
        */

    }

    /**
     * Test a call to  the 'CalculationOfPHDStudentPayment' function of the 
     * PaymentController, providing an invalid date range and a valid 
     * 'id' field value for the users table 
     */
    public function testCalculationOfPHDStudentPaymentFails() {
        
        //get the first PHD student whose name is 'Alicia Reid'
        $phdStudent = User::where('name','=','Alicia Reid')->first();

        /*
            call the 'calculatePHDStudentPayment' function of the 'PaymentController'
            and set the value of the 'id' parameter to be the ID of the PHD student
            and set the value of the 'fromDate' parameter in YYYY-MM-DD format 
            (which the controller expect due to the way the dates are stored in the 
            database) to '2016-10-15' and the value of the 'toDate' parameter to
            '2015-11-15'
        */
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => $phdStudent->id,
            'fromDate' =>'2016-10-15',
            'toDate' => '2015-11-15'
        ));

        /*
            get the view returned from calling the 'calculatePHDStudentPayment'
            of the 'PaymentController'
        */
        $view = $response->original;

        /*
            assert that the value of the 'error' variable c0ntained
            in the view has a value of 
            'the date range entered was invalid, please make sure the from date is earlier than the to date.'
        */
        $this->assertEquals(
            'The date range entered was invalid, please make sure the from date is earlier than the to date.', 
            $view['error']
        );

    }
}
