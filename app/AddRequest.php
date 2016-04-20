<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AddRequest extends Model{
	protected $table = 'activities_request';
	protected $fillable =  ['activity_id', 'user_id', 'supervisor_comment', 'supervisor_confirmation', 'status'];


    public function activity()
    {
        return $this->belongsTo('App\Activity', 'activity_id', 'id');
    }

    public function phd()
    {
        return $this->belongsTo('App\PhdStudent', 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\UserMod', 'user_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany('App\ActSession', 'activity_id', 'activity_id')->orderBy('date_of_session', 'asc');
    }
    
}
