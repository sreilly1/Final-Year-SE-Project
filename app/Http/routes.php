<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student/options', function () {
    return view('student-options');
});

Route::get('/lol', function () {
    return view('jobDescription');
});

Route::get('/calculatePHDStudentPayForm', function () {
    return view('/calculatePHDStudentPayForm');
});


Route::resource('job', 'JobController');

Route::resource('EngagementForm', 'EngagementFormController');

Route::get('/assignment', function() {
	return view('assignment');
});

Route::get('intuitiveAssignment', [
	'as' => 'intuitiveAssignment',
    'uses' => 'IntuitiveAssignmentController@performIntuitiveAssignment'
]);

Route::get('moduleExpenditure/{id}/{fromDate}/{toDate}', [
    'as' => 'moduleExpenditure',
    'uses' => 'ExpenditureController@calculateModuleExpenditure'
]);

Route::get('calculatePHDStudentPaymentResults/{id}/{fromDate}/{toDate}', [
    'as' => 'phdStudentPayment',
    'uses' => 'PaymentController@calculatePHDStudentPayment'
]);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('auth/logout', 'Auth\AuthController@logout');

});
