<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * Get the support activities(labs, tutorials, etc) that relate to this module.
     */
    public function activities() {

    	//use some information from here (one to many relationship between Session and Activity):
    	//https://laravel.com/docs/master/eloquent-relationships#one-to-many
    	return $this->hasMany('App\Activity');
    }
}
