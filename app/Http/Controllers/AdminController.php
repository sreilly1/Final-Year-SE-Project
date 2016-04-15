<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Activity;
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

class AdminController extends Controller
{



	public function choose()
	{
		$admins = UserMod::where('role', '=', 'Administrator')->get();
		return View::make("Admin")
		->with('admins', $admins);
	}





	// Panel


	public function panel($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$user = UserMod::where('id', $user_id)->first();
			$activities = Activity::with('module')->get();
			$module = Module::with('activities')->with('user')->get();
			$lecturers = UserMod::where('role', '=', 'Lecturer')->get();
			$Admins = UserMod::where('role', '=', 'Administrator')->get();
			$archive = Archive::get();
			$users = EmailUser::get();
			$users_requests = AddRequest::get();
			$pending = AddRequest::where('status', '=', 'Pending')->count();

			return View::make("Admin-panel")
			->with('user', $user)
			->with('module', $module)
			->with('lecturers', $lecturers)
			->with('activities', $activities)
			->with('archive', $archive)
			->with('users', $users)
			->with('requests', $users_requests)
			->with('Admins', $Admins)
			->with('pending', $pending);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}







	public function index()
	{
		$activities = Activity::with('module')->get();
		$module = Module::with('activities')->with('user')->get();
		$lecturers = UserMod::where('role', '=', 'Lecturer')->get();
		$Admins = UserMod::where('role', '=', 'Administrator')->get();
		$archive = Archive::get();
		$users = EmailUser::get();
		$users_requests = AddRequest::get();



		return View::make("Admin")
		->with('module', $module)
		->with('lecturers', $lecturers)
		->with('activities', $activities)
		->with('archive', $archive)
		->with('users', $users)
		->with('requests', $users_requests)
		->with('Admins', $Admins);
	}



	// Add Functions:

	public function adminAddUsr($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			MakeUser::create(array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password'),
				'title'=>Input::get('title'),
				'name'=>Input::get('name'),
				'email'=>Input::get('email'),
				'phone_number'=>Input::get('phone_number'),
				'room_number'=>Input::get('room_number'),
				'role'=>Input::get('role'),

			));
			Session::flash('success', "Account was successfully created");
			return back()->withInput();

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	
	public function addAct()
	{
		AddActivity::create(array(
			'title'=>Input::get('title'),
			'role_type'=>Input::get('role_type'),
			'module_id'=>Input::get('module_id'),
			'quant_ppl_needed'=>Input::get('quant_ppl_needed'),
		));

		return redirect('Admin')->with('status', 'Activity was Added!');
		
	}


	public function addPhd($user_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			MakeUser::create(array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password'),
				'title'=>Input::get('title'),
				'name'=>Input::get('name'),
				'email'=>Input::get('email'),
				'phone_number'=>Input::get('phone_number'),
				'room_number'=>Input::get('room_number'),
				'role'=>Input::get('role'),

			));

			// Session::flash('success', "Account was successfully created");
			// return back()->withInput();
			return redirect('Admin/'.$user_id.'/Users/Create/PhdStudent/Info');

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}


	public function addPhdInfo($user_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			

			if (PhdStudent::where('user_id', '=', Input::get('user_id'))->exists()) {

				Session::flash('ErrMessage', "This PhD Student has been previously assigned with Supervisor!");
			   	return redirect('Admin');
			} else {

				$supervisor_id = Input::get('supervisor_id');

				if($supervisor_id === 'null'){
			        PhDStudent::create(array(
						'user_id'=>Input::get('user_id'),
						'student_id'=>Input::get('student_id'),
						'year_of_study'=>Input::get('year_of_study'),
						'hours_per_week'=>Input::get('hours_per_week'),
						'supervisor_id'=>null,
					));

					Session::flash('success', "Account was successfully created");
					return redirect('Admin/'.$user_id.'/Users/Create/PhdStudent');
			    } else {
			    	PhDStudent::create(array(
						'user_id'=>Input::get('user_id'),
						'student_id'=>Input::get('student_id'),
						'supervisor_id'=>Input::get('supervisor_id'),
						'year_of_study'=>Input::get('year_of_study'),
						'hours_per_week'=>Input::get('hours_per_week'),
					));

					Session::flash('success', "Account was successfully created");
					// return back()->withInput();
					return redirect('Admin/'.$user_id.'/Users/Create/PhdStudent');
			    }
			}

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}





	// Update Functions

	


	// public function updateUsr(Request $requests, $id)
	// {
		
	// 	$data = array(
	// 			'title' => $requests->input('title'),
	// 			'username' => $requests->input('username'),
	// 			'name' => $requests->input('name'),
	// 			'email' => $requests->input('email'),
	// 			'password' => $requests->input('password'),
	// 			'phone_number' => $requests->input('phone_number'),
	// 			'room_number' => $requests->input('room_number'),
	// 			'role' => $requests->input('role'),
	// 		);
	// 	$ch = DB::table('users')->where('id', $id)->update($data);
	// 	if($ch > 0)
	// 	{
	// 		return redirect('Admin');
	// 	}
		
	// }



	public function updateAct(Request $requests, $id)
	{
		
		$data = array(
				'title' => $requests->input('title'),
				'role_type' => $requests->input('role_type'),
				'module_id' => $requests->input('module_id'),
				'quant_ppl_needed' => $requests->input('quant_ppl_needed'),
			);
		$ch = DB::table('activities')->where('id', $id)->update($data);
		if($ch > 0)
		{
			return redirect('Admin');
		}
		
	}



	// Updating PhD Student Details
	// From users table:


	public function updateUsr(Request $requests, $id)
	{
		
		$data = array(
				'title' => $requests->input('title'),
				'username' => $requests->input('username'),
				'name' => $requests->input('name'),
				'email' => $requests->input('email'),
				'password' => $requests->input('password'),
				'phone_number' => $requests->input('phone_number'),
				'room_number' => $requests->input('room_number'),
				'role' => $requests->input('role'),
			);
		$ch = DB::table('users')->where('id', $id)->update($data);
		Session::flash('success', "Account details were successfully updated");
		return back()->withInput();
		
	}





	// Emailing Fnctions


	public function adminEmail(Request $requests, $user_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			// This is where system stores "Archive" of mails been sent from Admin to any person
			Archive::create(array(
				'email_subject'=>Input::get('subject'),
				'rec_name'=>Input::get('getterName'),
				'rec_email'=>Input::get('email'),
				'message'=>Input::get('message'),
			));

			// This is where system generates e-mail from information taking from "form"
		  	$contactName = Input::get('getterName');
		    $contactEmail = Input::get('email');
		    $contactMessage = Input::get('message');
		    $messageSubject = Input::get('subject');
		    $admin = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

		    $data = array('name'=>$contactName, 'Recemail'=>$contactEmail, 'Emessage'=>$contactMessage, 'sender'=>$admin->name);
		    Mail::send('test', $data, function($message) use ($contactEmail, $contactName, $messageSubject)
		    {   
		        $message->to($contactEmail, $contactName)->subject($messageSubject);
		    });

			Session::flash('email_success', "");
			return back()->withInput();

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}




	public function adminEmailUsr(Request $requests, $user_id)
	{
		$user_email = Input::get('email');
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('email', $user_email)->exists()){
			
			// This is where system stores "Archive" of mails been sent from Admin to any person
			Archive::create(array(
				'email_subject'=>Input::get('subject'),
				'rec_name'=>Input::get('getterName'),
				'rec_email'=>Input::get('email'),
				'message'=>Input::get('message'),
			));



			// This is where system generates e-mail from information taking from "form"
		  	$contactName = Input::get('getterName');
		    $contactEmail = Input::get('email');
		    $contactMessage = Input::get('message');
		    $messageSubject = Input::get('subject');
		    $admin = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

		    $data = array('name'=>$contactName, 'Recemail'=>$contactEmail, 'Emessage'=>$contactMessage, 'sender'=>$admin->name);
		    Mail::send('emailUsr', $data, function($message) use ($contactEmail, $contactName, $messageSubject)
		    {   
		        $message->to($contactEmail, $contactName)->subject($messageSubject);
		    });
			Session::flash('user_email_success', "");
			return back()->withInput();
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}





	








	// Old Idea that would be useful with old verison of Database:


	// public function assignAdmin()
	// {
	// 	administrator::create(array(
	// 		'user_id'=>Input::get('user_id'),
	// 	));
	// 	return redirect('Admin')->with('status', 'User been assigned as Administrator!');
	// }

	// public function assignLect()
	// {
	// 	Lecturers::create(array(
	// 		'user_id'=>Input::get('user_id'),
	// 	));
	// 	return redirect('Admin')->with('status', 'User been assigned as Lecturer!');
	// }



	public function AssiPhD()
	{

		$supervisor_id = Input::get('supervisor_id');

		if($supervisor_id === 'null'){
	        PhDStudent::create(array(
				'user_id'=>Input::get('user_id'),
				'student_id'=>Input::get('student_id'),
				'year_of_study'=>Input::get('year_of_study'),
				'hours_per_week'=>Input::get('hours_per_week'),
				'supervisor_id'=>null,
			));
			Session::flash('user_success', "User was successfully created");
			Session::flash('no_leader', "This user has no supervisor, It would be better to assign one!");
			return redirect('Admin/Modules')->withInput();
	    } else {
	    	PhDStudent::create(array(
				'user_id'=>Input::get('user_id'),
				'student_id'=>Input::get('student_id'),
				'supervisor_id'=>Input::get('supervisor_id'),
				'year_of_study'=>Input::get('year_of_study'),
				'hours_per_week'=>Input::get('hours_per_week'),
			));
			Session::flash('user_success', "User was successfully created");
			return redirect('Admin/Modules')->withInput();
	    }

		return redirect('Admin/Users/Create');
	}



	// Create users page:


	public function usersPage($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			
			$user = UserMod::where('id', $user_id)->first();
			return View::make("Admin-users")
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}



	public function usersViewPage($user_id, $id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

			if($id === 'Create'){

				return View::make("Admin-users-create")
				->with('user', $user);

			} elseif ($id === 'Modify') {

				if(UserMod::exists()){

				} else {
					Session::flash('no_users', "You have no users records");
				}

				$users = UserMod::get();
				return View::make("Admin-users-manage")
				->with('user', $user)
				->with('users', $users);

				
			} else {

				if(UserMod::where('id', $id)->exists())
				{
					$module = Module::with('activities')->with('user')->where('module_leader', '=', $id)->get();
					$viewed_user = UserMod::where('id', $id)->first();
					$phd = PhDStudent::where('supervisor_id','=' ,$id)->with('user')->get();
					$phdInfo = PhDStudent::where('user_id','=' ,$id)->with('supervisor')->first();
					$applications = AddRequest::where('user_id','=' ,$id)->get();
					

					// If loops for Lecturer
					if(Module::with('activities')->with('user')->where('module_leader', '=', $id)->exists())
					{
						
					}else{
						Session::flash('no_modules', "This Lecturer has no current modules");
					}

					if(PhDStudent::where('supervisor_id','=' ,$id)->with('user')->exists())
					{
						
					}else{
						Session::flash('no_phd', "This Lecturer is not currently a supervisor of any PhD student");
					}


					// If loops for PhD Student
					if(PhDStudent::where('user_id','=' ,$id)->with('supervisor')->exists())
					{

					}	else{

						Session::flash('no_phd_info', "This PhD Student has no study details in our records!");
					}


					if(AddRequest::where('user_id','=' ,$id)->exists())
					{

					}	else{

						Session::flash('no_applications', "This PhD Student has not requested any applications yet!");
					}

					if(AddRequest::where('user_id','=' ,$id)->where('status','=' ,'Accepted')->exists())
					{
						// For confirmed support activities
						$confirmed_sa = AddRequest::where('user_id','=' ,$id)->where('status','=' ,'Accepted')->with('activity')->with('sessions')->get();

					}	else{

						Session::flash('no_confirmed_applications', "This PhD Student has currently no operated support activity");
						$confirmed_sa = AddRequest::where('user_id','=' ,$id)->where('status','=' ,'Accepted')->with('activity')->with('sessions')->get();
					}



					Session::flash('no_module_leader_information', "This PhD Student has no Supervisor details in our records");
					return View::make("Admin-users-view")
					->with('phdInfo', $phdInfo)
					->with('viewed_user', $viewed_user)
					->with('phd', $phd)
					->with('module', $module)
					->with('applications', $applications)
					->with('confirmed_sa', $confirmed_sa)
					->with('user', $user);

				} else{
					Session::flash('failed', "Something went wrong, please try again!");
					return back()->withInput();
				}	
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}

		
		
	}



	public function createUsersAdmin($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			
			return View::make("Admin-users-create-admin")
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}

	public function createUsersLecturer($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			
			return View::make("Admin-users-create-lecturer")
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}	
		
	}


	// PhD Student adding process:
	// As PhD Student record requires two tables in DB; 1: (users) table 2: (Phd_students) table
	// Therefore, whenever Admin wants to create PhD student, firstly admin should fill all user information,
	// Then once this was confirmed, Admin will be redirected to page where PhD student details should show up



	public function createUsersPhdStudent($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			
			return View::make("Admin-users-create-phd")
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}




	public function PhdStudentInfo($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$phd = DB::table('users')->where('role', '=', 'PHD Student')->orderBy('created_at', 'desc')->first();
			$users = DB::table('users')->where('role', '=', 'Lecturer')->get();
			
			return View::make("Admin-users-create-phd-info")
			->with('phd', $phd)
			->with('users', $users)
			->with('user', $user);;			

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	
	// Manage section:

	// (1) Manage PhD Students:

	public function PhdStudentManage($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$phd = DB::table('users')->where('role', '=', 'PHD Student')->get();
			return View::make("Admin-users-manage-phd")
			->with('phds', $phd)
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}


	public function phdEdit($user_id, $id)
	{
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			if(PhDStudent::where('user_id','=' ,$id)->with('supervisor')->exists())
			{
				$phd = UserMod::where('role', '=', 'PHD Student')->find($id);
				$lecturer = UserMod::where('role', '=', 'Lecturer')->get();
				$phdInfo = PhDStudent::where('user_id','=' ,$id)->with('supervisor')->first();
				return View::make("Admin-users-manage-phd-edit")
				->with('user', $user)
				->with('lecturer', $lecturer)
				->with('phdInfo', $phdInfo)
				->with('phd', $phd);

			}else{
				Session::flash('no_supervisor', "This PhD Student has no study details in our records!");
				$phd = UserMod::where('role', '=', 'PHD Student')->find($id);
				$lecturer = UserMod::where('role', '=', 'Lecturer')->get();
				return View::make("Admin-users-manage-phd-edit")
				->with('user', $user)
				->with('lecturer', $lecturer)
				->with('phd', $phd);
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function updatePhD(Request $requests, $user_id, $id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'PHD Student')->exists()){

			$data = array(
					'title' => $requests->input('title'),
					'username' => $requests->input('username'),
					'name' => $requests->input('name'),
					'email' => $requests->input('email'),
					'password' => $requests->input('password'),
					'phone_number' => $requests->input('phone_number'),
					'room_number' => $requests->input('room_number'),
					'role' => $requests->input('role'),
				);
			$ch = DB::table('users')->where('id', $id)->update($data);
			Session::flash('success', "Account details were successfully updated");
			return back()->withInput();
		} else {


			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function updatePhDInf(Request $requests, $user_id, $id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'PHD Student')->exists() and PhDStudent::where('user_id', $id)->exists()){

			$supervisor_id = Input::get('supervisor_id');

			if($supervisor_id === 'null'){

				$data = array(
					'student_id' => $requests->input('student_id'),
					'supervisor_id' => $requests->null,
					'year_of_study' => $requests->input('year_of_study'),
				);


			} else {

				$data = array(
					'student_id' => $requests->input('student_id'),
					'supervisor_id' => $requests->input('supervisor_id'),
					'year_of_study' => $requests->input('year_of_study'),
				);
			}

			
			$ch = DB::table('phd_students')->where('user_id','=' ,$id)->update($data);
			if($ch > 0) {

				Session::flash('success', "Account details were successfully updated");
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




	


	public function PhdStudentDelete($user_id, $id)
	{	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'PHD Student')->exists()){

			$PhdInfo= PhDStudent::where('user_id', $id);
			$User = UserMod::where('role', '=', 'PHD Student')->find($id);
		    $PhdInfo->delete();
		    $User->delete();

	    	Session::flash('user_deleted', "User was successfully deleted");
	    	return redirect('Admin/'.$user_id.'/Users/Modify/PhdStudent');

		} else {
			
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}







	// (2) Manage Admins



	public function AdminManage($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$admins = UserMod::where('role', '=', 'Administrator')->get();
			return View::make("Admin-users-manage-admin")
			->with('admins', $admins)
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
		
	}


	public function adminEdit($user_id, $id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$admin = UserMod::where('role', '=', 'Administrator')->find($id);
			return View::make("Admin-users-manage-admin-edit")
			->with('admin', $admin)
			->with('user', $user);
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
		
	}





	public function updateAdmin(Request $requests, $user_id, $id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'Administrator')->exists()){

			$data = array(
					'title' => $requests->input('title'),
					'username' => $requests->input('username'),
					'name' => $requests->input('name'),
					'email' => $requests->input('email'),
					'password' => $requests->input('password'),
					'phone_number' => $requests->input('phone_number'),
					'room_number' => $requests->input('room_number'),
					'role' => $requests->input('role'),
				);
			$ch = DB::table('users')->where('id', $id)->update($data);
			Session::flash('success', "Account details were successfully updated");
			return back()->withInput();

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function AdminDelete($user_id, $id)
	{	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'Administrator')->exists()){

			$User = UserMod::where('role', '=', 'Administrator')->find($id);
		    $User->delete();

	    	Session::flash('user_deleted', "User was successfully deleted");
	    	return redirect('Admin/'.$user_id.'/Users/Modify/Admin');

		} else {
			
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}


	// (3) Manage Lecturers:



	public function LecturerManage($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$lecturer = DB::table('users')->where('role', '=', 'Lecturer')->get();
			return View::make("Admin-users-manage-lecturer")
			->with('lecturer', $lecturer)
			->with('user', $user);
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
		
	}


	public function lecturerEdit($user_id, $id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'Lecturer')->exists()){

			$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
			$phd = PhDStudent::where('supervisor_id','=' ,$id)->with('user')->get();
			$module = Module::with('activities')->with('user')->where('module_leader', '=', $id)->get();
			$lecturer = UserMod::where('role', '=', 'Lecturer')->find($id);

			if(Module::with('activities')->with('user')->where('module_leader', '=', $id)->exists())
			{
				
			}else{
				Session::flash('no_modules', "This Lecturer has no current modules");
			}

			if(PhDStudent::where('supervisor_id','=' ,$id)->with('user')->exists())
			{
				
			}else{
				Session::flash('no_phd', "This Lecturer is not currently a supervisor of any PhD student");
			}


			return View::make("Admin-users-manage-lecturer-edit")
			->with('lecturer', $lecturer)
			->with('module', $module)
			->with('phd', $phd)
			->with('user', $user);

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}

	


	public function updateLecturer(Request $requests, $user_id, $id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'Lecturer')->exists()){

			$data = array(
					'title' => $requests->input('title'),
					'username' => $requests->input('username'),
					'name' => $requests->input('name'),
					'email' => $requests->input('email'),
					'password' => $requests->input('password'),
					'phone_number' => $requests->input('phone_number'),
					'room_number' => $requests->input('room_number'),
					'role' => $requests->input('role'),
				);
			$ch = DB::table('users')->where('id', $id)->update($data);
			Session::flash('success', "Account details were successfully updated");
			return back()->withInput();
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function LecturerDelete($user_id, $id)
	{	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and UserMod::where('id', $id)->where('role', '=', 'Lecturer')->exists()){

			$User = UserMod::where('role', '=', 'Lecturer')->find($id);
		    $User->delete();

	    	Session::flash('user_deleted', "User was successfully deleted");
	    	return redirect('Admin/'.$user_id.'/Users/Modify/Lecturer');

		} else {
			
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}












	// Modules:

	public function ModulesPage($user_id)
	{
		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			if(Module::exists())
			{
				$modules = Module::with('user')->get();
			} else{
				$modules = Module::get();
				Session::flash('no_modules', "There are no existed modules in our records");
			}


			return View::make("Admin-modules")
			->with('modules', $modules)
			->with('user', $user);
		} else {
			
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	public function ModuleViewPage($user_id, $id)
	{

		
		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			if($id === 'Add'){

				$lecturers = UserMod::where('role', '=', 'Lecturer')->get();
				return View::make("Admin-modules-add")
				->with('lecturers', $lecturers)
				->with('user', $user);

			} else {

				if(Module::where('id', $id)->exists())
				{

					if(Activity::where('module_id', $id)->exists())
					{
						$module = Module::where('id', $id)->with('user')->first();
						$activities = Activity::where('module_id', $id)->get();
						$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

						return View::make("Admin-modules-view")
						->with('module', $module)
						->with('activities', $activities)
						->with('user', $user);
						
					} else{
						Session::flash('no_activities', "This module has no support activities");
						$module = Module::where('id', $id)->with('user')->first();
						$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

						return View::make("Admin-modules-view")
						->with('module', $module)
						->with('user', $user);
					}
				} else{

					Session::flash('failed', "Something went wrong, please try again!");
					return back()->withInput();
				}
			}

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}

		
	}


	public function modifyModule($user_id, $id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and Module::where('id', $id)->exists()){
			Session::flash('no_module_leader_information', "No module leader information existed in our records for this module");
			if(Activity::where('module_id', $id)->exists())
			{
				$activities = Activity::where('module_id', $id)->get();
				$module = Module::with('activities')->with('user')->find($id);
				$lecturers = UserMod::where('role', '=', 'Lecturer')->get();

				return View::make("Admin-modules-edit")
				->with('module', $module)
				->with('lecturers', $lecturers)
				->with('activities', $activities)
				->with('user', $user);
				
			}else{
				Session::flash('no_activities', "This module has no support activities");
				$module = Module::with('activities')->with('user')->find($id);
				$lecturers = UserMod::where('role', '=', 'Lecturer')->get();

				return View::make("Admin-modules-edit")
				->with('module', $module)
				->with('lecturers', $lecturers)
				->with('user', $user);
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function addMod($user_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$module_leader = Input::get('module_leader');

			if($module_leader === 'null'){
		        Module::create(array(
					'module_name'=>Input::get('module_name'),
					'module_code'=>Input::get('module_code'),
					'module_leader'=>null,
				));
				Session::flash('success', "Module was successfully created");
				Session::flash('no_leader', "This Module has no Module Leader, It would be better to assign module leader!");
				return back()->withInput();

		    } else {
		    	Module::create(array(
					'module_name'=>Input::get('module_name'),
					'module_code'=>Input::get('module_code'),
					'module_leader'=>Input::get('module_leader')
				));

				Session::flash('success', "Module was successfully created");
				return back()->withInput();
		    }
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function updateMod(Request $requests, $user_id, $id)
	{
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and Module::where('id', $id)->exists()){

			$module_leader = Input::get('module_leader');
			if($module_leader === 'null'){
		        $data = array(
					'module_name' => $requests->input('module_name'),
					'module_code' => $requests->input('module_code'),
					'module_leader' =>null,
				);
				$ch = DB::table('modules')->where('id', $id)->update($data);
				if($ch > 0)
				{
					Session::flash('success', "Module was successfully updated");
			    	return back()->withInput();
				}

		    }else{

		    	$data = array(
					'module_name' => $requests->input('module_name'),
					'module_code' => $requests->input('module_code'),
					'module_leader' => $requests->input('module_leader'),
				);
				$ch = DB::table('modules')->where('id', $id)->update($data);
				if($ch > 0)
				{
					Session::flash('success', "Module was successfully updated");
			    	return back()->withInput();
				}
		    }
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}




	public function deleteModule($user_id, $id)
	{	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and Module::where('id', $id)->exists()){

			$module = DB::table('modules')->where('id', $id);
	    	$module->delete();
	    	Session::flash('module_deleted', "Module was successfully deleted");
	    	return redirect('Admin/'.$user_id.'/Modules');

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}

	


	





	// Activities:

	public function ActivitiesPage($user_id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			if(Activity::exists())
			{
				$activities = Activity::with('module')->get();
				return View::make("Admin-activities")
				->with('activities', $activities)
				->with('user', $user);
			} else{

				Session::flash('no_activities', "There are no existed activities in our records");
				return View::make("Admin-activities");
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function ActivityViewPage($user_id, $id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			if($id === 'Add'){

				$modules = Module::get();
				return View::make("Admin-activities-add")
				->with('modules', $modules)
				->with('user', $user);

			} elseif ($id === 'Sessions'){

				$sessions = ActSession::with('activity')->get();

				if(ActSession::exists()){

				} else {
					Session::flash('no_sessions', "No sessions records existed in DB!");
				}

				return View::make("Admin-activities-sessions")
				->with('sessions', $sessions)
				->with('user', $user);

			} else {

				if(Activity::where('id', $id)->exists())
				{
					Session::flash('no_module', "No module information existed in our records for this activity");
					$activities = Activity::where('id', $id)->with('module')->first();
					$sessions = ActSession::where('activity_id', $id)->get();
					$phds = AddRequest::where('activity_id', $id)->where('status', '=', 'Accepted')->with('user')->with('phd')->get();

					if(ActSession::where('activity_id', $id)->exists()){

					} else {
						Session::flash('no_sessions', "This Activity does not have any session, please add some");
					}

					if(AddRequest::where('activity_id', $id)->where('status', '=', 'Accepted')->exists()){

					} else {
						Session::flash('no_students', "This Activity does not have any operated students yet");
					}
					

					return View::make("Admin-activities-view")
					->with('activity', $activities)
					->with('sessions', $sessions)
					->with('phds', $phds)
					->with('user', $user);


				} else {
					Session::flash('no_activities', "You're trying to access page that does not exists");
					return View::make("Admin-activities-view");
				}	
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function addActivity($user_id)
	{

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			$module_id = Input::get('module_id');

			if($module_id === 'null'){
		        Activity::create(array(
					'title'=>Input::get('title'),
					'role_type'=>Input::get('role_type'),
					'module_id'=>null,
					'quant_ppl_needed'=>Input::get('quant_ppl_needed'),
				));
				Session::flash('activity_success', "Activity was successfully created");
				return back()->withInput();
		    }else{
		    	Activity::create(array(
					'title'=>Input::get('title'),
					'role_type'=>Input::get('role_type'),
					'module_id'=>Input::get('module_id'),
					'quant_ppl_needed'=>Input::get('quant_ppl_needed'),
				));
				Session::flash('activity_success', "Activity was successfully created");
				return back()->withInput();
		    }
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}




	public function modifyActivities($user_id, $id)
	{
		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			Session::flash('no_module', "No module information existed in our records for this activity");
			$module = Module::get();
			$activity = Activity::with('module')->find($id);
			$sessions = ActSession::where('activity_id', $id)->get();

			return View::make("Admin-activities-edit")
			->with('activity', $activity)
			->with('module', $module)
			->with('user', $user)
			->with('sessions', $sessions);	
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
				
	}



	// Update Activity:


	public function updateActivity(Request $requests, $user_id, $id)
	{
		

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and Activity::where('id', $id)->exists()){

			$module_id = Input::get('module_id');

			if($module_id === 'null'){
		        $data = array(
					'title' => $requests->input('title'),
					'role_type' => $requests->input('role_type'),
					'module_id' =>null,
					'quant_ppl_needed' => $requests->input('quant_ppl_needed'),
				);
				$ch = Activity::where('id', $id)->update($data);
				if($ch > 0)
				{
					Session::flash('success', "Activity was successfully updated");
			    	return back()->withInput();
				}

		    } else {

		    	$data = array(
					'title' => $requests->input('title'),
					'role_type' => $requests->input('role_type'),
					'module_id' => $requests->input('module_id'),
					'quant_ppl_needed' => $requests->input('quant_ppl_needed'),
				);
				$ch = Activity::where('id', $id)->update($data);
				if($ch > 0)
				{
					Session::flash('success', "Activity was successfully updated");
			    	return back()->withInput();
				}
		    }

		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}

	public function deleteActivity($id)
	{	
			
		$activity = Activity::where('id', $id);
	    $activity->delete();

	    Session::flash('activity_deleted', "Activity was successfully deleted");
	    return redirect('Admin/Activities');
	}



	







	// Sessions of Activities


	public function SessionPages($user_id, $id)
	{
		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			if($id === 'Add'){

				$activities = Activity::get();
				return View::make("Admin-activities-sessions-add")
				->with('activities', $activities)
				->with('user', $user);

			} else {

				if(ActSession::where('id', $id)->exists())
				{
					$session = ActSession::where('id', $id)->with('activity')->first();
					return View::make("Admin-activities-sessions-view")
					->with('session', $session)
					->with('user', $user);

				} else{

					Session::flash('failed', "Something went wrong, please try again!");
					return back()->withInput();
				}	
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}


	public function addSession($user_id)
	{
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			

			$session_date = Input::get('date_of_session');
			$session_db_date = date("Y-m-d", strtotime($session_date));

			ActSession::create(array(
				'activity_id'=>Input::get('activity_id'),
				'date_of_session'=>$session_db_date,
				'start_time'=>Input::get('start_time'),
				'end_time'=>Input::get('end_time'),
				'location'=>Input::get('location'),
				));
			Session::flash('session_success', "Session was successfully created");
			return back()->withInput();
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}


	

	public function SessionsModifyPage($user_id, $id)
	{	

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$session = ActSession::where('id', $id)->first();
			return View::make("Admin-activities-session-edit")
			->with('session', $session)
			->with('user', $user);	
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
		
	}





	

	public function updateSession(Request $requests, $user_id, $id)
	{

		$session_date = Input::get('date_of_session');
		$session_db_date = date("Y-m-d", strtotime($session_date));
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			$data = array(
				'date_of_session'=>$session_db_date,
				'start_time' => $requests->input('start_time'),
				'end_time' => $requests->input('end_time'),
				'location' => $requests->input('location'),
				);

			$ch = ActSession::where('id', $id)->update($data);
			if($ch > 0)
			{
				Session::flash('success', "Session was successfully updated");
				return back()->withInput();
			}
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	// Support Activity Requests Functions

	// Requests section -> View Requested activities + make actions

	public function requests($user_id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){

			if(AddRequest::exists()){

			} else {
				Session::flash('no_requests', "You don't have any requests yet!");
			}

			$acc_requests = AddRequest::where('status', '=', 'Accepted')->with('activity')->with('phd')->get();
			$dec_requests = AddRequest::where('status', '=', 'Declined')->with('activity')->with('phd')->get();
			$pending_requests = AddRequest::where('status', '=', 'Pending')->with('activity')->with('phd')->get();


			if(AddRequest::where('status', '=', 'Accepted')->exists()){

			} else {
				Session::flash('no_accepted', "");
			}


			if(AddRequest::where('status', '=', 'Declined')->exists()){

			} else {
				Session::flash('no_declined', "");
			}



			if(AddRequest::where('status', '=', 'Pending')->with('activity')->exists()){

			} else {
				Session::flash('no_requests_not_responded', "There are no requests done by any student yet!");
			}


			return View::make("Admin-req")
			->with('not_responded', $pending_requests)
			->with('acc_requests', $acc_requests)
			->with('dec_requests', $dec_requests)
			->with('user', $user);	

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}


	// Accepted requests page

	public function acceptedRequests($user_id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		


		if(AddRequest::where('status', '=', 'Declined')->exists()){

		} else {
			Session::flash('no_declined', "");
		}


		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			if(AddRequest::where('status', '=', 'Accepted')->with('activity')->with('phd')->exists()){
				$acc_requests = AddRequest::where('status', '=', 'Accepted')->with('activity')->with('phd')->get();
				if(AddRequest::where('status', '=', 'Accepted')->exists()){
				} else {
					Session::flash('no_requests', "Looks like you have no requests that were accepted!");
				}
				return View::make("Admin-req-accepted")
				->with('acc_requests', $acc_requests)
				->with('user', $user);
			} else {
				Session::flash('failed', "There are no accepted requests");
				return back()->withInput();
			}
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}




	// Accepted request full details:

	public function acceptedRequestsView($user_id, $student_id, $req_id, $act_id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and PhDStudent::where('user_id', $student_id)->exists() and AddRequest::where('status', '=', 'Accepted')->where('id', $req_id)->where('user_id', $student_id)->where('activity_id', $act_id)->exists()){

			$Phd = PhDStudent::where('user_id', $student_id)->with('user')->with('supervisor')->first();
			$request = AddRequest::where('status', '=', 'Accepted')->with('activity')->with('phd')->first();
			$activity = Activity::where('id', $act_id)->with('module')->first();
			$sessions = ActSession::where('activity_id', $act_id)->get();


			if(AddRequest::where('status', '=', 'Accepted')->exists()){

			} else {
				Session::flash('no_requests', "Looks like you have no requests that were accepted!");
			}


			return View::make("Admin-req-accepted-view")
			->with('request', $request)
			->with('activity', $activity)
			->with('user', $user)
			->with('sessions', $sessions)
			->with('Phd', $Phd);	
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}




	


	//	Declined requests page 



	public function rejectedRequests($user_id)
	{

		$user = UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->first();
		


		if(AddRequest::where('status', '=', 'Accepted')->exists()){

		} else {
			Session::flash('no_accepted', "");
		}

		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			if(AddRequest::where('status', '=', 'Declined')->with('activity')->with('phd')->exists()){
				$dec_requests = AddRequest::where('status', '=', 'Declined')->with('activity')->with('phd')->get();
				if(AddRequest::where('status', '=', 'Declined')->exists()){

				} else {
					Session::flash('no_requests', "Looks like you have no requests that were rejected!");
				}
				return View::make("Admin-req-declined")
				->with('dec_requests', $dec_requests)
				->with('user', $user);	
			} else {
				Session::flash('failed', "There are no rejected requests");
				return back()->withInput();				
			}	
		} else {

			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}		
	}





	// Admin confirming requests

	public function requestsConfirm(Request $requests, $user_id, $req_id)
	{

		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and AddRequest::where('id', $req_id)->where('status', '=', 'Pending')->exists()){
			
			$data = array(
				'status' => $requests->input('status'),
			);

			$ch = AddRequest::where('id', $req_id)->update($data);

			Session::flash('success', "Confirmation was successfully done, User can now view all sessions on his/her panel");
			return redirect('Admin/'.$user_id.'/Requests');

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	// Admin rejecting requests

	public function requestsReject(Request $requests, $user_id, $req_id)
	{

		
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists() and AddRequest::where('id', $req_id)->where('status', '=', 'Pending')->exists()){
			
			$data = array(
				'status' => $requests->input('status'),
			);

			$ch = AddRequest::where('id', $req_id)->update($data);

			Session::flash('success', "Rejection was successfully done, User will receieve notifying that");
			return back()->withInput();

		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
	}



	public function viewreq($user_id, $id)
	{

		if (AddRequest::where('user_id', '=', $id)->exists()) {
			$usr = UserMod::where('id',$id)->get();
			$requests = AddRequest::with('activity')->where('user_id',$id)->get();
			//$requests = AddRequest::with('user')->find($id);
			return View::make("Admin-view-req")
			->with('requests', $requests)
			->with('phd_name', $usr);
		} else {
			return redirect('Admin/Requests')->withErrors(['You are trying to access page that is not existed', '']);
		}
		
	}





	public function reqAction(Request $requests, $user_id, $id)
	{
		
		$data = array(

				'status' => $requests->input('status'),
			);
		$ch = DB::table('activities_request')->where('id', $id)->update($data);
		return back()->withInput();
	}












	// Deleting processes:


	public function destroyAct($id)
	{	
		
	    $act = DB::table('activities')->where('id', $id);
	    $act->delete();

	    return redirect('Admin');
	}


	public function destroyMod($id)
	{	
		
	    $act = DB::table('modules')->where('id', $id);
	    $act->delete();

	    return redirect('Admin');
	}

	public function destroyUsr($id)
	{	
		
	    $act = DB::table('users')->where('id', $id);
	    $act->delete();

	    return redirect('Admin');
	}


	public function destroyPhDUsr($id)
	{	

		
		$PhdInfo= PhDStudent::where('user_id', $id);
		$User = UserMod::where('role', '=', 'PHD Student')->find($id);
	    $PhdInfo->delete();
	    $User->delete();

	    Session::flash('phd_deleted', "User was successfully deleted");
	    return redirect('Admin/Users/Modify/PhdStudent');
	}



	public function deleteSession($user_id, $id)
	{	
		if(UserMod::where('id', $user_id)->where('role', '=', 'Administrator')->exists()){
			$session = ActSession::where('id', $id);
		    $session->delete();

		    Session::flash('session_deleted', "Session was successfully deleted");
		    return redirect('Admin/Activities/Sessions');
		} else {
			Session::flash('failed', "Something went wrong, please try again!");
			return back()->withInput();
		}
			
	}
}
