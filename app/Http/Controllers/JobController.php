<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Response;
use File;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
     /**
     * Serve up the job description in a secure manner and display it
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $jobDescription = Job::find($id); // find the job description whose id matches $id
        return Response::make(
        	File::get($jobDescription->storage_location),
        		200,
        		['Content-Type' => 'application/pdf']  // Set HTTP header to be 'application/pdf' to cause the browser to interpret the file as a PDF
        );
    }
}
