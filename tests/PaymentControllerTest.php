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
    public function testCalculatePHDStudentPaymentSuccess() {

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
            assert that the value of the 'totalPayment' variable contained
            in the view has a value of 227.9
        */
    	$this->assertEquals(227.9, $view['totalPayment']);


        /*
            assert that the value of the 'demonstratorHours' variable contained
            in the view has a value of 10
        */
    	$this->assertEquals(10, $view['demonstratorHours']);

        /*
            assert that the value of the 'teachingHours' variable contained
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
    /** @test */
    public function testCalculationOfPHDStudentPaymentInvalidDateRange() {

        //get the first PHD student whose name is 'Alicia Reid'
        $phdStudent = User::where('name','=','Alicia Reid')->first();

        /*
            call the 'calculatePHDStudentPayment' function of the 'PaymentController'
            and set the value of the 'id' parameter to be the ID of the PHD student
            and set the value of the 'fromDate' parameter in YYYY-MM-DD format 
            (which the controller expects due to the way the dates are stored in the 
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


        $errorsReceived = $view['errors'];
        /*
            assert that the assert that the 'errors' variable (which is an array)
            contained in the view has a value of
            'Please make sure the from date is earlier than the to date.'
        */
        $this->assertContains(
            'Please make sure the from date is earlier than the to date.', $errorsReceived
        );
    }

    /**
     * Test a call to  the 'CalculationOfPHDStudentPayment' function of the 
     * PaymentController, providing a date range and an 'id' value that does not exist
     * in the 'Users' table of the database
     */
    /** @test */
    public function testCalculationOfPHDStudentPaymentNonExistentPHDStudent() {

        /*
            call the 'calculatePHDStudentPayment' function of the 'PaymentController'
            and set the value of the 'id' parameter to be 1278910
            and set the value of the 'fromDate' parameter in YYYY-MM-DD format 
            (which the controller expect due to the way the dates are stored in the 
            database) to '2016-10-01' and the value of the 'toDate' parameter to
            '2016-11-10'
        */
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => 1278910,
            'fromDate' =>'2016-10-15',
            'toDate' => '2016-11-10'
        ));

        /*
            get the view returned from calling the 'calculatePHDStudentPayment'
            of the 'PaymentController'
        */
        $view = $response->original;


        $errorsReceived = $view['errors'];
        /*
            assert that the assert that the 'errors' variable (which is an array)
            contained in the view has a value of
            'The PHD student that you specified does not exist.'
        */
        $this->assertContains(
            'The PHD student that you specified does not exist.', $errorsReceived
        );
    }

    /**
     * Test a call to  the 'CalculationOfPHDStudentPayment' function of the 
     * PaymentController, providing dates in an invalid format, 
     * and a valid 'id' field value from the users table
     */
    /** @test */
    public function testCalculationOfPHDStudentPaymentIncorrectDateFormat() {
        //get the first PHD student whose name is 'Alicia Reid'
        $phdStudent = User::where('name','=','Alicia Reid')->first();

        /*
            call the 'calculatePHDStudentPayment' function of the 'PaymentController'
            and set the value of the 'id' parameter to be the ID of the PHD student
            and set the value of the 'fromDate' parameter to be the letter 'a' 
            (which the controller expects due to the way the dates are stored in the 
            database)  and the value of the 'toDate' parameter to
            to be the letter 'b'
        */
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => $phdStudent->id,
            'fromDate' =>'a',
            'toDate' => 'b'
        ));

        /*
            get the view returned from calling the 'calculatePHDStudentPayment'
            of the 'PaymentController'
        */
        $view = $response->original;


        $errorsReceived = $view['errors'];

        /*
            assert that the assert that the 'errors' variable (which is an array)
            contained in the view has a value of
            "Please ensure that you provide a 'from' and a 'to' date
            in the format yyyy-mm-dd."
        */
        $this->assertContains(
            "Please ensure that you provide a 'from' and a 'to' date
            in the format yyyy-mm-dd.", $errorsReceived
        );

    }
}
