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

    	//use some information from here (one to many relationship between Session and Activity):
    	//https://laravel.com/docs/master/eloquent-relationships#one-to-many
    	return $this->hasMany('App\Session');
    }

    /**
     * Get the activity requests (applications) for the support activity (lab, tutorial, etc).
     */
   	public function activityRequests() {
   		return $this->hasMany('App\ActivityRequest');
   	}

   	/**
     * Get the module that owns the support activity(lab, tutorial, etc).
     */
   	public function module() {
   		return $this->belongsTo('App\Module');
   	}
}
