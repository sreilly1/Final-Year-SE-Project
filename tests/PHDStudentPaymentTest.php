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
    		'fromDate' =>'2015-10-01',
    		'toDate' => '2016-10-31'
    	));



    	//see https://laravel.com/docs/4.2/testing
    	$view = $response->original;
    	$this->assertEquals(36, $view['totalExpenditure']);

    	$this->assertEquals(4, $view['demonstratorHours']);

    	$this->assertEquals(0, $view['teachingHours']);

    }
}
