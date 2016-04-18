<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Activity;
use App\AddModule;
use App\AddActivity;
use App\Archive;
use App\EmailUser;
use App\MakeUser;
use App\administrator;
use App\PhDStudent;
use App\AddRequest;
use App\UserMod;
use App\ActSession;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use illuminate\html;
use Illuminate\Support\Facades\Mail; 
use Session;

class LecturerController extends Controller
{


	// Page where we choose user

	public function choose()
	{
		$lecturers = UserMod::where('role', '=', 'Lecturer')->get();
		return View::make("Lecturer")
		->with('lecturers', $lecturers);
	}


	// Panel
	public function panel($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){

			// For emailing purposes:
			$sup_inv_ppl = PhDStudent::where('supervisor_id', $user_id)->with('user')->get();
			$admins = UserMod::where('role', '=', 'Administrator')->get();



			if(UserMod::where('role', '=', 'Administrator')->exists()){

			} else {
				Session::flash('no_admins', "");
			}


			if(PhDStudent::where('supervisor_id', $user_id)->with('user')->exists()){

			} else {
				Session::flash('no_phds', "");
			}


			$user = UserMod::where('id', $user_id)->first();
			return View::make("Lecturer-panel")
			->with('user', $user)
			->with('sup_ppl', $sup_inv_ppl)
			->with('admins', $admins);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}

	

	// Lecturer update info function:

	public function SupervisorUpdateInfo(Request $requests, $user_id)
	{

		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){
	        
	        $data = array(
				'title' => $requests->input('title'),
				'name' => $requests->input('name'),
				'username' => $requests->input('username'),
				'phone_number' => $requests->input('phone_number'),
				'room_number' => $requests->input('room_number'),
				'email' => $requests->input('email'),
				'password' => $requests->input('password'),

			);

			$ch = UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Your details were successfully updated");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}

	    }else{

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}

	


	// Lecturer module page
	public function ModPage($user_id)
	{

		$can_add = '0';

		if($can_add === '1'){

		} else {
			Session::flash('can_not_add', "");
		}

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){

			if(Module::where('module_leader', $user_id)->exists()){

			} else {

				Session::flash('no_modules', "Looks like you have no modules currently leading");
			}

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('module_leader', $user_id)->with('activities')->get();
			return View::make("Lecturer-panel-modules")
			->with('user', $user)
			->with('modules', $modules);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	// Lecturer module Add page
	public function AddModulePage($user_id)
	{
		
		// Allowing lecturer to add page if $can_add is = '1', however if this is = '0' he will not be able to add
		$can_add = '0';
		if($can_add === '1'){
			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){
				$user = UserMod::where('id', $user_id)->first();
				return View::make("Lecturer-panel-modules-add")
				->with('user', $user);

			} else {
				Session::flash('error_page', "Page you're trying to access does not exists");
				return back()->withInput();
			}

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Add module function

	public function AddModule($user_id)
	{

		$can_add = '0';
		$module_leader = Input::get('module_leader');

		if($can_add === '1' and $module_leader === $user_id and UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){
	        
	        Module::create(array(
				'module_name'=>Input::get('module_name'),
				'module_code'=>Input::get('module_code'),
				'module_leader'=>Input::get('module_leader'),
			));

			Session::flash('module_success', "Module was successfully created");
			return back()->withInput();

	    }else{
	  
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
	}


	// Add activity of module

	public function ModuleAddAct($user_id, $module_id)
	{
		
		

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists()){
			$user = UserMod::where('id', $user_id)->first();
			$module = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			return View::make("Lecturer-panel-modules-add-activity")
			->with('user', $user)
			->with('module', $module);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Add module function

	public function ModuleAddActAction($user_id, $module_id)
	{

		$module__id = Input::get('module_id');

		if($module_id === $module__id and UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists()){
	        
	        Activity::create(array(
				'module_id'=>Input::get('module_id'),
				'title'=>Input::get('title'),
				'role_type'=>Input::get('role_type'),
				'quant_ppl_needed'=>Input::get('quant_ppl_needed'),
				'description'=>Input::get('description'),
			));

			Session::flash('activity_success', "Activity was successfully created");
			return back()->withInput();

	    }else{
	  
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
	}


	// View module page

	public function ViewModule($user_id, $module_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activities = Activity::where('module_id', $module_id)->with('events')->get();

			if(Activity::where('module_id', $module_id)->exists()){

			} else {

				Session::flash('no_activities', "This Module has no activities");
			}

			Session::flash('can_delete', "");

			return View::make("Lecturer-panel-modules-view")
			->with('user', $user)
			->with('module', $modules)
			->with('activities', $activities);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Delete module function

	public function DeleteModule($user_id, $module_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists()){

			$Module = Module::where('id', $module_id)->where('module_leader', $user_id);
	    	$Module->delete();

	    	Session::flash('module_deleted', "Module was successfully deleted");
	    	return back()->withInput();


		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Edit module page

	public function ModifyModule($user_id, $module_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			return View::make("Lecturer-panel-modules-edit")
			->with('user', $user)
			->with('module', $modules);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Update Module Function 


	public function UpdateModule(Request $requests, $user_id, $module_id)
	{

		
		$module_leader = Input::get('module_leader');

		if($module_leader === $user_id and UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $module_leader)->exists()){
	        
	        $data = array(
				'module_name' => $requests->input('module_name'),
				'module_code' => $requests->input('module_code'),
				'module_leader' => $requests->input('module_leader'),
				'description' => $requests->input('description'),
			);

			$ch = Module::where('id', $module_id)->where('module_leader', $user_id)->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Module was successfully updated");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}

	    }else{

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}



	// View Activity of Module page

	public function ViewModuleAct($user_id, $module_id, $act_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activity = Activity::where('id', $act_id)->where('module_id', $module_id)->first();
			$sessions = ActSession::where('activity_id', $act_id)->get();
			$phds = AddRequest::where('activity_id', $act_id)->where('status', '=', 'Accepted')->with('user')->with('phd')->get();

			if(ActSession::where('activity_id', $act_id)->exists()){

			} else {

				Session::flash('no_sessions', "This Activity has no sessions");
			}

			if(AddRequest::where('activity_id', $act_id)->where('status', '=', 'Accepted')->exists()){

			} else {

				Session::flash('no_applicants', "There are no current operated students on this activity!");
			}


			return View::make("Lecturer-panel-modules-view-activity")
			->with('user', $user)
			->with('module', $modules)
			->with('activity', $activity)
			->with('sessions', $sessions)
			->with('phds', $phds);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Edit Activity of Module page

	public function ModifyModuleAct($user_id, $module_id, $act_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activity = Activity::where('id', $act_id)->where('module_id', $module_id)->first();
			return View::make("Lecturer-panel-modules-edit-activity")
			->with('user', $user)
			->with('module', $modules)
			->with('activity', $activity);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Update module's activity function:

	public function UpdateModuleAct(Request $requests, $user_id, $module_id, $act_id)
	{

	

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists()){
	        
	        
	        $data = array(
				'title' => $requests->input('title'),
				'role_type' => $requests->input('role_type'),
				'quant_ppl_needed' => $requests->input('quant_ppl_needed'),
				'description' => $requests->input('description'),
			);

			$ch = Activity::where('id', $act_id)->where('module_id', $module_id)->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Activity was successfully updated");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}

	    } else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}


	// Delete Support Activity Function

	

	public function DeleteModuleAct($user_id, $module_id, $act_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists()){

			$Activity = Activity::where('id', $act_id)->where('module_id', $module_id);
	    	$Activity->delete();

	    	Session::flash('activity_deleted', "Support Activity was successfully deleted");
	    	return redirect('Lecturer/'.$user_id.'/Modules/mod'.$module_id);


		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	// Add Session of Module's Activity:

	
	public function AddModuleActSession($user_id, $module_id, $act_id)
	{
		
		

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists()){
			
			$user = UserMod::where('id', $user_id)->first();
			$module = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activity = Activity::where('id', $act_id)->where('module_id', $module_id)->first();
			

			return View::make("Lecturer-panel-modules-add-activity-session")
			->with('user', $user)
			->with('module', $module)
			->with('activity', $activity);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Add function for session: 


	public function AddModuleActSessionAction($user_id, $module_id, $act_id)
	{

		$activity_id = Input::get('activity_id');
		
		$session_date = Input::get('date_of_session');
		$session_db_date = date("Y-m-d", strtotime($session_date));

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists() and $act_id === $activity_id){
	        
	        ActSession::create(array(
	        	'activity_id'=>Input::get('activity_id'),
				'title'=>Input::get('title'),
				'date_of_session'=>$session_db_date,
				'start_time'=>Input::get('start_time'),
				'end_time'=>Input::get('end_time'),
				'location'=>Input::get('location'),
			));

			Session::flash('session_success', "Session was successfully created");
			return back()->withInput();

	    }else{
	  
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
	}


	


	// View activity's session details

	public function ViewModuleActSession($user_id, $module_id, $act_id, $sess_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists() and ActSession::where('id', $sess_id)->where('activity_id', $act_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activity = Activity::where('id', $act_id)->where('module_id', $module_id)->first();
			$session = ActSession::where('id', $sess_id)->where('activity_id', $act_id)->first();
			$phds = AddRequest::where('activity_id', $act_id)->where('status', '=', 'Accepted')->with('user')->with('phd')->get();


			
			Session::flash('can_delete', "");

			if(AddRequest::where('activity_id', $act_id)->where('status', '=', 'Accepted')->exists()){

			} else {

				Session::flash('no_applicants', "There are no current operated students on this activity!");
			}


			return View::make("Lecturer-panel-modules-view-activity-session")
			->with('user', $user)
			->with('module', $modules)
			->with('activity', $activity)
			->with('session', $session)
			->with('phds', $phds);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Edit Activity of Module page

	public function ModifyModuleActSession($user_id, $module_id, $act_id, $sess_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists() and ActSession::where('id', $sess_id)->where('activity_id', $act_id)->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$modules = Module::where('id', $module_id)->where('module_leader', $user_id)->first();
			$activity = Activity::where('id', $act_id)->where('module_id', $module_id)->first();
			$session = ActSession::where('id', $sess_id)->where('activity_id', $act_id)->first();
			return View::make("Lecturer-panel-modules-edit-activity-session")
			->with('user', $user)
			->with('module', $modules)
			->with('activity', $activity)
			->with('session', $session);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// Update module's activity function:

	public function UpdateModuleActSession(Request $requests, $user_id, $module_id, $act_id, $sess_id)
	{

	

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists() and ActSession::where('id', $sess_id)->where('activity_id', $act_id)->exists()){
	        

	        $session_date = Input::get('date_of_session');
			$session_db_date = date("Y-m-d", strtotime($session_date));
	        
	        $data = array(
				'date_of_session' =>$session_db_date,
				'title' => $requests->input('title'),
				'start_time' => $requests->input('start_time'),
				'end_time' => $requests->input('end_time'),
				'location' => $requests->input('location'),
			);

			$ch = ActSession::where('id', $sess_id)->where('activity_id', $act_id)->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Session was successfully updated");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}

	    } else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}


	

	// Delete Session function


	public function DeleteModuleActSession($user_id, $module_id, $act_id, $sess_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and Module::where('id', $module_id)->where('module_leader', $user_id)->exists() and Activity::where('id', $act_id)->where('module_id', $module_id)->exists() and ActSession::where('id', $sess_id)->where('activity_id', $act_id)->exists()){

			$Session = ActSession::where('id', $sess_id)->where('activity_id', $act_id);
	    	$Session->delete();

	    	Session::flash('success', "Session was successfully deleted");
	    	return redirect('Lecturer/'.$user_id.'/Modules/mod'.$module_id.'/Act'.$act_id);


		} else {

			Session::flash('failed', "Something went wrong!, please try again or contact Technical Support");
			return back()->withInput();
		}
	}







	// Supervision features

	public function SupervisionPage($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->first();
			$users = PhDStudent::where('supervisor_id', $user_id)->with('user')->with('requests')->get();

			foreach ($users as $student){
				$requests = AddRequest::where('user_id', '=', $student->user_id)->where('supervisor_confirmation', '=', 'Pending')->where('status', '=', 'Pending')->with('activity')->with('phd')->get();
			}

			if(PhDStudent::where('supervisor_id', $user_id)->exists()){

			} else {
				Session::flash('no_students', "You have no phd students that you're supervisor of in our records!");
			}

			return View::make("Lecturer-panel-supervision")
			->with('users', $users)
			->with('user', $user)
			->with('requests', $requests);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	public function SupervisionViewRequests($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists()){
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->first();
			$students = PhDStudent::where('supervisor_id', $user_id)->get();

			foreach ($students as $student){
				$requests = AddRequest::where('user_id', '=', $student->user_id)->where('supervisor_confirmation', '=', 'Pending')->where('status', '=', 'Pending')->with('activity')->with('phd')->get();
			}
			return View::make("Lecturer-panel-supervision-requests")
			->with('user', $user)
			->with('requests', $requests);
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}




	public function SupervisionViewStudentPage($user_id, $student_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->first();
			$student = PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->with('user')->first();
			$requests = AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Pending')->where('status', '=', 'Pending')->with('activity')->get();
			$confirmed_requests = AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->where('status', '=', 'Pending')->with('activity')->get();
			$declined_requests = AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->where('status', '=', 'Pending')->with('activity')->get();
			

			if(AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Pending')->where('status', '=', 'Pending')->with('activity')->exists()){

			} else {

				Session::flash('no_requests', "This student does not have any applications requested");
			}

			if(AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->where('status', '=', 'Pending')->exists() or AddRequest::where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->where('status', '=', 'Pending')->exists()){

			} else {

				Session::flash('no_ongoing', "This student does not have any applications requested");
			}


			Session::flash('no_confirmed_applications', "This student does not have any support activity that currently operated");

			return View::make("Lecturer-panel-supervision-view-student")
			->with('user', $user)
			->with('student', $student)
			->with('requests', $requests)
			->with('confirmed', $confirmed_requests)
			->with('declined', $declined_requests);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}
	


	// Update module's activity function:

	public function SupervisionConfirmStudentReq(Request $requests, $user_id, $student_id, $request_id)
	{

	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->exists()){
	        
	        
	        $data = array(
				'supervisor_comment' => $requests->input('supervisor_comment'),
				'supervisor_confirmation' => 'Confirmed',
			);

			$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

			if($ch > 0)
			{
				Session::flash('success', "Your confirmation was successfully processed!");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}

	    } else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}



	public function SupervisionRejectStudentReq(Request $requests, $user_id, $student_id, $request_id)
	{

	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists()){
	        
	        
	        $data = array(
				'supervisor_comment' => $requests->input('supervisor_comment'),
				'supervisor_confirmation' => 'Declined',
			);

			$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

			if($ch > 0)
			{
				Session::flash('success', "Your rejection was successfully processed!");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Failed!");
				return back()->withInput();
			}

	    } else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
	    }
		
	}




	
	// Update module's activity function:



	public function SupervisionEditRejectStudentReq(Request $requests, $user_id, $student_id, $request_id)
	{

		$reason = Input::get('reason');
		$new_comment = Input::get('supervisor_comment');
		$new_confirmation = Input::get('supervisor_confirmation');

		$old_comment = AddRequest::where('id', $request_id)->where('user_id', $student_id)->pluck('supervisor_comment');
		


		if($reason === '' and $new_comment === '' and $new_confirmation === 'Declined'){

			Session::flash('failed', "Nothing was changed, please check that you're actually updating something");
			return back()->withInput();

		} elseif ($reason != '' and $new_comment === '' and $new_confirmation === 'Declined'){

			Session::flash('failed', "You're trying to provide reason where you have not make any changes, Please make sure you're actually changing something to be able to provide reason");
			return back()->withInput();
		} elseif ($new_comment != '' and $reason === '') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  -  New Comment: '.$requests->input('supervisor_comment'),
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} elseif ($new_comment === '' and $reason != '') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason:  '.$requests->input('reason').' -  No New Comment Given'.$requests->$old_comment,
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} elseif ($new_comment === '' and $reason === '' and $new_confirmation != 'Declined') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason: NOT GIVEN -  No New Comment Given'.$requests->$old_comment,
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} else {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Declined')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason:  '.$requests->input('reason').' -  New Comment: '.$requests->input('supervisor_comment'),
					'supervisor_confirmation' => $requests->input('supervisor_confirmation'),
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }
		}		
	}



	public function SupervisionEditConfirmStudentReq(Request $requests, $user_id, $student_id, $request_id)
	{

		$reason = Input::get('reason');
		$new_comment = Input::get('supervisor_comment');
		$new_confirmation = Input::get('supervisor_confirmation');

		$old_comment = AddRequest::where('id', $request_id)->where('user_id', $student_id)->pluck('supervisor_comment');
		


		if($reason === '' and $new_comment === '' and $new_confirmation === 'Confirmed'){

			Session::flash('failed', "Nothing was changed, please check that you're actually updating something");
			return back()->withInput();
		} elseif ($reason != '' and $new_comment === '' and $new_confirmation === 'Confirmed'){

			Session::flash('failed', "You're trying to provide reason where you have not make any changes, Please make sure you're actually changing something to be able to provide reason");
			return back()->withInput();
		} elseif ($new_comment != '' and $reason === '') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  -  New Comment: '.$requests->input('supervisor_comment'),
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} elseif ($new_comment === '' and $reason != '') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason:  '.$requests->input('reason').' -  No New Comment Given'.$requests->$old_comment,
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} elseif ($new_comment === '' and $reason === '' and $new_confirmation != 'Confirmed') {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason: NOT GIVEN -  No New Comment Given',
					'supervisor_confirmation' => $requests->input('supervisor_confirmation') ,
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }

		} else {

			if(UserMod::where('id', $user_id)->where('role', '=', 'Lecturer')->exists() and PhDStudent::where('supervisor_id', $user_id)->where('user_id', $student_id)->exists() and AddRequest::where('id', $request_id)->where('user_id', $student_id)->where('supervisor_confirmation', '=', 'Confirmed')->exists()){
	        
		        
		        $data = array(
					'supervisor_comment' => '[Changed]  Reason:  '.$requests->input('reason').' -  New Comment: '.$requests->input('supervisor_comment'),
					'supervisor_confirmation' => $requests->input('supervisor_confirmation'),
				);

				$ch = AddRequest::where('id', $request_id)->where('user_id', $student_id)->update($data);

				if($ch > 0)
				{
					Session::flash('success', "Your confirmation was successfully processed!");
			    	return back()->withInput();

				} else {

					Session::flash('failed', "Failed!");
					return back()->withInput();
				}

		    } else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
		    }
		}		
	}




}
