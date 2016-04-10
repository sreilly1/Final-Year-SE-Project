<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PHDStudentPaymentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculationOfPHDStudentPayment() {
        $response = $this->action('GET', 'PaymentController@calculatePHDStudentPayment', array(
            'id' => 55,
            'fromDate' =>'2015-10-15',
            'toDate' => '2015-11-15'
        ));

    	$view = $response->original;
    	$this->assertEquals(36, $view['totalExpenditure']);

    	$this->assertEquals(4, $view['demonstratorHours']);

    	$this->assertEquals(0, $view['teachingHours']);


    }
}
