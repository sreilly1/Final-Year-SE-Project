<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	/**
     * Get the support activity that owns the session.
     */
    public function activity () {

    	//use some information from here (one to many relationship between Session and Activity):
    	//https://laravel.com/docs/master/eloquent-relationships#one-to-many
    	return $this->belongsTo('App\Activity');
    }
}
