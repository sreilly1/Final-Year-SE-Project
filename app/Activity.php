<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    /**
     * Get the sessions for the support activity(lab, tutorial, etc).
     */
    public function sessions() {

    	
    	return $this->hasMany('App\Session');
    }

 /**
     * Get the activity requests (applications) for the support activity (lab, tutorial, etc).
     */
   	public function activityRequests() {
   		return $this->hasMany('App\ActivityRequest');
   	}


    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'id');
    }


    public function applications()
    {
        return $this->hasMany('App\addRequest', 'id', 'activity_id');
    }

    // public function sessions()
    // {
    //     return $this->hasMany('App\ActSession', 'id', 'activity_id')->orderBy('date_of_session', 'asc');
    // }

    public function events()
    {
        return $this->hasMany('App\ActSession')->orderBy('date_of_session', 'asc');
    }

    /**
     * return the succesful applications for the support activity.
     */
    public function getSuccessfulApplications() {
      return $this->activityRequests()->where('request_status', '=', 'confirmed');
    }

}


     
