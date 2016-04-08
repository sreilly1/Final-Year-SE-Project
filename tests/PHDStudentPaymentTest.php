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
    public function testThingy() {
    	//$this->visit('/http://localhost:8000/phdStudentExpenditure/55/2016-04-01/2016-04-30')
    		// ->see('Responsive Tables');
    	$response = $this->action('GET', 'ExpenditureController@calculatePHDStudentExpenditure', array(
    		'id' => 55,
    		'fromDate' => '2016-04-01',
    		'toDate' => '2016-04-30'
    	));



    	//see https://laravel.com/docs/4.2/testing
    	$view = $response->original;
    	$this->assertEquals(44, $view['totalExpenditure']);

    	$this->assertEquals(4, $view['demonstratorHours']);

    	$this->assertEquals(1, $view['teachingHours']);

    }
}
