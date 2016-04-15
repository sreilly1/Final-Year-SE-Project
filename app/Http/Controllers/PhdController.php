<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhdStudent;
use App\UserMod;
use App\Module;
use App\Activity;
use App\AddRequest;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use illuminate\html;
use Illuminate\Support\Facades\Mail; 
use DB;
use Session;

class PhdController extends Controller
{
	public function choose()
	{
		$phds = UserMod::where('role', '=', 'PHD Student')->get();
		return View::make("Phd")
		->with('phds', $phds);
	}




	public function panel($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$admins = UserMod::where('role', '=', 'Administrator')->get();
			$phd_supervisor = PhDStudent::where('user_id', $user_id)->with('supervisor')->first();

			// Counting requests:
			$pending = AddRequest::where('user_id', $user_id)->where('status', '=', 'Pending')->count();
			$accepted = AddRequest::where('user_id', $user_id)->where('status', '=', 'Accepted')->count();
			$rejected = AddRequest::where('user_id', $user_id)->where('status', '=', 'Declined')->count();


			if(UserMod::where('role', '=', 'Administrator')->exists()){

			} else {
				Session::flash('no_admins', "");
			}

			if(PhDStudent::where('user_id', $user_id)->whereNotNull('supervisor_id')->with('supervisor')->exists()){

			} else {
				Session::flash('no_supervisor', "");
			}


			return View::make("Phd-panel")
			->with('user', $user)
			->with('admins', $admins)
			->with('phd_supervisor', $phd_supervisor)
			->with('pending', $pending)
			->with('accepted', $accepted)
			->with('rejected', $rejected);
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	// User update info:

	public function updateInfo(Request $requests, $user_id)
	{

		
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists()){
	        
	        $data = array(
				'title' => $requests->input('title'),
				'name' => $requests->input('name'),
				'username' => $requests->input('username'),
				'phone_number' => $requests->input('phone_number'),
				'room_number' => $requests->input('room_number'),
				'email' => $requests->input('email'),
				'password' => $requests->input('password'),

			);

			$ch = UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Your details were successfully updated");
		    	return back()->withInput();

			} else {

				Session::flash('failed', "Something went wrong, please try again!");
				return back()->withInput();
			}
	    }else{

			return View::make("AccessProh");
	    }	
	}



	public function engagement($user_id)
	{
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists()){
			$module = Module::with('activities')->get();
			$usr = UserMod::where('role', '=', 'PHD Student')->find($user_id);
			return View::make("Phd-panel-eng")
			->with('user', $usr)
			->with('module', $module);
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}


	public function engagementModule($user_id, $module_id)
	{		
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists() and Activity::where('module_id', $module_id)->with('module')->exists()){
			$module = Module::where('id', $module_id)->first();
			$usr = UserMod::where('role', '=', 'PHD Student')->find($user_id);
			$phd = PhDStudent::where('user_id', $user_id)->with('supervisor')->first();
			$activities = Activity::where('module_id', $module_id)->with('module')->get();			
			return View::make("Phd-panel-eng-module")
			->with('user', $usr)
			->with('module', $module)
			->with('activities', $activities)
			->with('phd', $phd);
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}



	

	public function ReqAct($user_id, $module_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists() and Module::where('id', $module_id)->exists()){
			if (AddRequest::where('user_id', '=', Input::get('user_id'))->where('activity_id', '=', Input::get('activity_id'))->exists()) {
					Session::flash('ErrMessage', "You already have requested this activity before");
			   		return back()->withInput();
			} else {


				$activity_id = Input::get('activity_id');
				$supervisor_mail = Input::get('supervisor');
				$activity = Activity::where('id', $activity_id)->with('module')->first();
				$messageSubject = 'Application Requested';
				$user = UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->first();
				$student_name = $user->name;
				$student_email = $user->email;
				$activity_title = $activity->title;
				$activity_module = $activity->module->module_name;

				AddRequest::create(array(
					'activity_id'=>Input::get('activity_id'),
					'user_id'=>Input::get('user_id'),
					'status'=>Input::get('status'),
				));

				$data = array('name'=>$student_name, 'Recemail'=>$student_email, 'activity_title'=>$activity_title, 'activity_module'=>$activity_module);
			    Mail::send('applicationRequest', $data, function($message) use ($student_email, $student_name, $messageSubject)
			    {   
			        $message->to($student_email, $student_name)->subject($messageSubject);
			    });

				Session::flash('message', "Request was successfully sent!, an email was sent to you showing your application's details");
				return back()->withInput();
			}
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		} 	
	}



	public function PhDRequests($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists() and AddRequest::where('user_id', $user_id)->exists()){
			$usr = UserMod::where('role', '=', 'PHD Student')->find($user_id);
			$requests = AddRequest::where('user_id', $user_id)->with('activity')->get();

			return View::make("Phd-panel-req")
			->with('user', $usr)
			->with('requests', $requests);

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		} 	
	}



	public function JobSessions($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists() and AddRequest::where('user_id', $user_id)->where('status', '=', 'Accepted')->exists()){
			$usr = UserMod::where('role', '=', 'PHD Student')->find($user_id);
			$requests = AddRequest::where('user_id', $user_id)->where('status', '=', 'Accepted')->with('activity')->with('sessions')->get();

			return View::make("Phd-panel-job")
			->with('user', $usr)
			->with('requests', $requests);

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		} 	
	}

	public function JobSessionsAct($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'PHD Student')->exists() and AddRequest::where('user_id', $user_id)->where('status', '=', 'Accepted')->exists()){
			$usr = UserMod::where('role', '=', 'PHD Student')->find($user_id);
			$requests = AddRequest::where('user_id', $user_id)->where('status', '=', 'Accepted')->with('activity')->with('sessions')->get();

			return View::make("Phd-panel-job-act")
			->with('user', $usr)
			->with('requests', $requests);

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		} 	
	}
}
