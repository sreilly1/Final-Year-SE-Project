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

Route::get('/calculatePHDStudentPayForm', function () {
    return view('/calculatePHDStudentPayForm');
});

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
Route::resource('PhdPanel', 'PHDPANELController');
Route::group(['middleware' => 'web'], function() {
    // Choose pages:
    Route::get('Admin', 'AdminController@choose');
    Route::get('Lecturer', 'LecturerController@choose');
    // PhD main page and panel:
    Route::get('Phd', 'PhdController@choose');
    Route::get('Phd/{user_id}', 'PhdController@panel');
    // PhD Engagement form
    Route::get('Phd/{user_id}/Engagement-Form', 'PhdController@engagement');
    // Studnet should view all available modules to access their support activities
    // Module page:
    Route::get('Phd/{user_id}/Engagement-Form/Mod-{module_id}', 'PhdController@engagementModule');
    // Requesting support activity
    Route::post('Phd/{user_id}/Engagement-Form/{module_id}/ReqAct', 'PhdController@ReqAct');
    // Manage details:
    Route::post('Phd/{user_id}/updateInfo', 'PhdController@updateInfo');
    // View ongoing activities:
    Route::get('Phd/{user_id}/Requests', 'PhdController@PhDRequests');
    // View job sessions:
    Route::get('Phd/{user_id}/JobSessions', 'PhdController@JobSessions');
    // View job session by activities:
    Route::get('Phd/{user_id}/JobSessions/ByAct', 'PhdController@JobSessionsAct');
    
    // Admin Panel:
    Route::get('Admin/{user_id}', 'AdminController@panel');
    // Admin Create users page:
    Route::get('Admin/{user_id}/Users', 'AdminController@usersPage');
    Route::get('Admin/{user_id}/Users/{id}', 'AdminController@usersViewPage');
    Route::get('Admin/{user_id}/Users/Create/Admin', 'AdminController@createUsersAdmin');
    Route::get('Admin/{user_id}/Users/Create/Lecturer', 'AdminController@createUsersLecturer');
    // Add administrator:
    
    Route::post('Admin/{user_id}/Users/Create/Lecturer/addUser', 'AdminController@adminAddUsr');
    Route::post('Admin/{user_id}/Users/Create/Admin/addUser', 'AdminController@adminAddUsr');
    // Create PhD Student:
    // First Get user information
    // Then complete process by also getting PhD details -> Student ID + Year of Study + Supervisor?
    Route::get('Admin/{user_id}/Users/Create/PhdStudent', 'AdminController@createUsersPhdStudent');
    Route::get('Admin/{user_id}/Users/Create/PhdStudent/Info', 'AdminController@PhdStudentInfo');
    Route::post('Admin/{user_id}/Users/Create/addPhd', 'AdminController@addPhd');
    Route::post('Admin/{user_id}/Users/Create/PhdStudent/addPhdInfo', 'AdminController@addPhdinfo');
    // Manage existed users
    // Manage PhD students main page
    Route::get('Admin/{user_id}/Users/Modify/PhdStudent/', 'AdminController@PhdStudentManage');
    Route::get('Admin/{user_id}/Users/Modify/PhdStudent/{id}', 'AdminController@phdEdit');
    Route::post('Admin/{user_id}/Users/Modify/PhdStudent/{id}/updateUsr', 'AdminController@updatePhD');
    Route::get('Admin/{user_id}/Users/PhdStudent/{id}/Delete', 'AdminController@PhdStudentDelete');
    Route::post('Admin/{user_id}/Users/Modify/PhdStudent/{id}/updatePhDInf', 'AdminController@updatePhDInf');
    // Manage Admin users main page
    Route::get('Admin/{user_id}/Users/Modify/Admin/', 'AdminController@AdminManage');
    Route::get('Admin/{user_id}/Users/Modify/Admin/{id}', 'AdminController@adminEdit');
    Route::get('Admin/{user_id}/Users/Admin/{id}/Delete', 'AdminController@AdminDelete');
    Route::post('Admin/{user_id}/Users/Modify/Admin/{id}/updateUsr', 'AdminController@updateAdmin');
    // Manage Lecturer users main page
    Route::get('Admin/{user_id}/Users/Modify/Lecturer', 'AdminController@LecturerManage');
    Route::get('Admin/{user_id}/Users/Modify/Lecturer/{id}', 'AdminController@lecturerEdit');
    Route::get('Admin/{user_id}/Users/Lecturer/{id}/Delete', 'AdminController@lecturerDelete');
    Route::post('Admin/{user_id}/Users/Modify/Lecturer/{id}/updateUsr', 'AdminController@updateLecturer');
    // Modules Page
    Route::get('Admin/{user_id}/Modules', 'AdminController@ModulesPage');
    
    Route::get('Admin/{user_id}/Modules/{id}', 'AdminController@ModuleViewPage');
    // Modules add page:
    Route::get('Admin/{user_id}/Modules/Add', 'AdminController@ModulesAddPage');
    Route::post('Admin/{user_id}/Modules/addMod', 'AdminController@addMod');
    // Delete Module:
    Route::get('Admin/{user_id}/Modules/Delete/{id}', 'AdminController@deleteModule');
    // Modify Pages:
    Route::get('Admin/{user_id}/Modules/Modify/{id}', 'AdminController@modifyModule');
    // Update Module:
    Route::post('Admin/{user_id}/Modules/{id}/updateMod', 'AdminController@updateMod');
    // Support Activity Page
    Route::get('Admin/{user_id}/Activities', 'AdminController@ActivitiesPage');
    Route::get('Admin/{user_id}/Activities/{id}', 'AdminController@ActivityViewPage');
    // Activities add page:
    Route::get('Admin/{user_id}/Activities/Add', 'AdminController@ActivityAddPage');
    Route::post('Admin/{user_id}/Activities/Add/Action', 'AdminController@addActivity');
    // Modify Activity:
    Route::get('Admin/{user_id}/Activities/Modify/{id}', 'AdminController@modifyActivities');
    // Update Activity:
    Route::post('Admin/{user_id}/Activities/{id}/Update', 'AdminController@updateActivity');
    // Delete Activity:
    Route::get('Admin/{user_id}/Activity/Delete/{id}', 'AdminController@deleteActivity');
    // Sessions:
    Route::get('Admin/{user_id}/Activities/Sessions', 'AdminController@SessionsPage');
    Route::get('Admin/{user_id}/Activities/Sessions/{id}', 'AdminController@SessionPages');
    // Modify Session:
    Route::get('Admin/{user_id}/Activities/Sessions/{id}/Modify', 'AdminController@SessionsModifyPage');
    // Add Session:
    Route::post('Admin/{user_id}/Activities/Sessions/Add/Action', 'AdminController@addSession');
    // Update Session:
    Route::post('Admin/{user_id}/Activities/Sessions/{id}/Update', 'AdminController@updateSession');
    // Delete Session:
    Route::get('Admin/{user_id}/Activities/Sessions/{id}/Delete', 'AdminController@deleteSession');
    // Requests:
    // Pending
    Route::get('Admin/{user_id}/Requests', 'AdminController@requests');
    // Accepted
    Route::get('Admin/{user_id}/Requests/Accepted', 'AdminController@acceptedRequests');
    Route::get('Admin/{user_id}/Requests/Accepted/Usr{student_id}Req{req_id}Act{act_id}', 'AdminController@acceptedRequestsView');
    // Declined
    Route::get('Admin/{user_id}/Requests/Declined', 'AdminController@rejectedRequests');
    Route::post('Admin/{user_id}/Requests/Confirm{req_id}', 'AdminController@requestsConfirm');
    Route::post('Admin/{user_id}/Requests/Reject{req_id}', 'AdminController@requestsReject');    
    
    Route::get('Admin/{user_id}/Requests/{id}', 'AdminController@viewreq');
    
    Route::post('Admin/{user_id}/Requests/reqAction/{id}', 'AdminController@reqAction');
    // Admin emailing system:
    Route::post('Admin/{user_id}/email', 'AdminController@adminEmail');
    Route::post('Admin/{user_id}/emailUsr', 'AdminController@adminEmailUsr');
    
    // <--      Lecturer Section      -->
    // Lecturer panel:
    Route::get('Lecturer/{user_id}', 'LecturerController@panel');
    // Lecturer module, support activities, sessions --> pages:
    Route::get('Lecturer/{user_id}/Modules', 'LecturerController@ModPage');
    Route::get('Lecturer/{user_id}/Modules/Add', 'LecturerController@AddModulePage');
    Route::post('Lecturer/{user_id}/Modules/Add/Action', 'LecturerController@AddModule');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}', 'LecturerController@ViewModule');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Delete', 'LecturerController@DeleteModule');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Modify', 'LecturerController@ModifyModule');
    Route::post('Lecturer/{user_id}/Modules/mod{module_id}/Modify/Action', 'LecturerController@UpdateModule');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Modify/addAct', 'LecturerController@ModuleAddAct');
    Route::post('Lecturer/{user_id}/Modules/mod{module_id}/Modify/addAct/Action', 'LecturerController@ModuleAddActAction');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}', 'LecturerController@ViewModuleAct');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Delete', 'LecturerController@DeleteModuleAct');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Modify', 'LecturerController@ModifyModuleAct');
    Route::post('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Modify/Action', 'LecturerController@UpdateModuleAct');
    Route::get('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/AddSession', 'LecturerController@AddModuleActSession');
    Route::post('Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/AddSession/Action', 'LecturerController@AddModuleActSessionAction');
    Route::get('/Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Ses{sess_id}', 'LecturerController@ViewModuleActSession');
    Route::get('/Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Ses{sess_id}/Modify', 'LecturerController@ModifyModuleActSession');
    Route::get('/Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Ses{sess_id}/Delete', 'LecturerController@DeleteModuleActSession');
    Route::post('/Lecturer/{user_id}/Modules/mod{module_id}/Act{act_id}/Ses{sess_id}/Modify/Action', 'LecturerController@UpdateModuleActSession'); 
    
    // Lecturer Supervision features:
    Route::get('/Lecturer/{user_id}/Sup', 'LecturerController@SupervisionPage');
    Route::get('/Lecturer/{user_id}/Sup/Requests', 'LecturerController@SupervisionViewRequests');
    Route::get('/Lecturer/{user_id}/Sup/Stu{student_id}', 'LecturerController@SupervisionViewStudentPage');
    
    // Confirming function of PhD Student Application with commenting
    Route::post('Lecturer/{user_id}/Sup/Stu{student_id}/confirmReq{request_id}', 'LecturerController@SupervisionConfirmStudentReq');
    Route::post('Lecturer/{user_id}/Sup/Stu{student_id}/rejectReq{request_id}', 'LecturerController@SupervisionRejectStudentReq');
    Route::post('Lecturer/{user_id}/Sup/Stu{student_id}/editAcceptedReq{request_id}', 'LecturerController@SupervisionEditConfirmStudentReq');
    Route::post('Lecturer/{user_id}/Sup/Stu{student_id}/editRejectReq{request_id}', 'LecturerController@SupervisionEditRejectStudentReq');
    
    // Lecturer updating user info:  
    Route::post('Lecturer/{user_id}/updateInfo', 'LecturerController@SupervisorUpdateInfo');
    // Update:
    Route::post('updateUsr/{id}', 'AdminController@updateUsr');
    Route::post('updateAct/{id}', 'AdminController@updateAct');
    Route::post('updateUsr/{id}', 'AdminController@updateUsr');
    Route::post('updatePhDUsrInfo/{id}', 'AdminController@updatePhDUsrInfo');
    // Add Functions:
    Route::post('addUsr', 'AdminController@addUsr');
    Route::post('addMod', 'AdminController@addMod');
    Route::post('addAct', 'AdminController@addAct');
    // Delete Functions
    Route::post('deleteAct/{id}', 'AdminController@destroyAct');
    Route::post('deleteMod/{id}', 'AdminController@destroyMod');
    Route::post('deleteUsr/{id}', 'AdminController@destroyUsr');
    Route::post('deletePhdUsr/{id}', 'AdminController@destroyPhDUsr');



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
