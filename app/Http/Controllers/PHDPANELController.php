<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Activity;
use App\AddModule;
use App\AddActivity;
use App\Lecturers;
use App\Archive;
use App\EmailUser;
use App\MakeUser;
use App\administrator;
use App\PhDStudent;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use illuminate\html;
use Illuminate\Support\Facades\Mail; 

class PHDPANELController extends Controller
{
	public function index()
	{
		return View::make("PhdPanel");
	}

}
