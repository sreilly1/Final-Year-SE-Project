<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class ExpenditureController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @param  int  $id, date $fromDate, date $toDate
	 * @return Response T0D0: replace 'Resp0nse' with what is actually returned
	 */
    public function calculatePHDStudentExpenditure() {
    	$phdStudents = User::where('role','=','PHD Student')->get();
    	foreach ($phdStudents as $phdStudent) {
    		echo $phdStudents . "\n" ;
    	}

    	//return $phdStudents;
    }
}


