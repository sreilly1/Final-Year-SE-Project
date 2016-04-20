<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\AddModule;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;

class AddModules extends Controller
{
	public function add()
	{
		AddModule::create(array(
			'module_name'=>Input::get('module_name'),
			'module_code'=>Input::get('module_code'),
			'module_leader'=>Input::get('module_leader')
		));
		
	}

}
