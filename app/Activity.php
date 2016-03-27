<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Session;

class Activity extends Model
{
    protected $table = 'activities';

    /**
     * Get the sessions for the supprt activity(lab, tutorial, etc).
     */
    public function sessions() {

    	//use some information from here (one to many relationship between Session and Activity):
    	//https://laravel.com/docs/master/eloquent-relationships#one-to-many
    	return $this->hasMany('App\Session');
    }
}
