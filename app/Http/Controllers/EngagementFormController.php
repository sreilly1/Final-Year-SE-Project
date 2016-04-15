<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Activity;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class EngagementFormController extends Controller
{
	public function index()
	{




		$activities = Activity::with('module')->get();
		$module = Module::with('activities')->get();

		return View::make("Engagement-Form")
		->with('module', $module)
		->with('activities', $activities);


		//$modules=Module::join('activities','activities.module_id','=','modules.id')
		//	->get();

		//return View::make("Engagement-Form")->with('modules', $modules);


		// $modules = DB::table('modules')
	 //   		->get();

	 //   	$activities = DB::table('activities')
	 //    	->join->on('modules', 'activities.module_id', '=', 'modules.id')
	 //   		->get();

  //  		return View::make("Engagement-Form")->with('modules', $modules)
  //  			->with('activities', $activities);


	    //$activities = Module::with('activities')->find($id)->activities;
	    //return View::make("Engagement-Form")->with('activities', $activities);
	}
}
