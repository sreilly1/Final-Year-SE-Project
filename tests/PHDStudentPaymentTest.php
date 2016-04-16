<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentControllerTest extends TestCase
{

    //see http://code.tutsplus.com/tutorials/testing-laravel-controllers--net-31456 f0r these tests


    /**
     * Test a call to the 'checkDateRangeValidity' function of the 
     * PaymentController, providing an invalid date range
     */
    public function testCalculationOfPHDStudentPaymentSucceedsFails() {
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => 55,
            'fromDate' =>'2016-10-15',
            'toDate' => '2015-11-15'
        ));
        $view = $response->original;
        $this->assertEquals('The date range entered was invalid, please make sure the from date is earlier than the to date.', $view['error']);
    }

    /**
     * Test a call to  the 'CalculationOfPHDStudentPayment' function of the 
     * PaymentController, providing a valid date range
     */
    //public function testCalculationOfPHDStudentPaymentSucceeds() {
    //     $respasnse = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
    //         'id' => 55,
    //         'fromDate' =>'2015-10-15',
    //         'toDate' => '2015-11-15'
    //     ));

    //     $expectedHoursWorkedToRoleMapping = array(
    //         'Demonstrator' => 4,
    //         'Teaching' => 0
    //     );

    // 	$view = $response->original;
    // 	$this->assertEquals(36, $view['totalExpenditure']);
    //     $actualHoursWorkedToRoleMapping = $view['hoursWorkedToRoleMapping'];
    //     var_dump( $actualHoursWorkedToRoleMapping);
    //     $this->assertEquals($expectedHoursWorkedToRoleMapping['Demonstrator'], $view['hoursWorkedToRoleMapping']['Demonstrator']);
    //     //$this->assertEquals(ksort($expectedHoursWorkedToRoleMapping), ksort($actualHoursWorkedToRoleMapping), $canonicalize = true);
    //     //$this->assertEquals($expectedHoursWorkedToRoleMapping, $view['hoursWorkedToRoleMapping']);
    //     //print ($actualHoursWorkedToRoleMapping === $expectedHoursWorkedToRoleMapping);
        

    // 	//$this->assertEquals(4, $view['demonstratorHours']);

    // 	//$this->assertEquals(0, $view['teachingHours']);
    // }
}
