<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EngagementFormController extends Controller
{
    public function index()
    {
    	$modules=Module::all();
    	return View::make("Engagement-Form")->with('modules', $modules);

    }
}
