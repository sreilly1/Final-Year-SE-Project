<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model{

	protected $table = 'activities';
	protected $fillable =  ['id', 'title', 'role_type', 'module_id','quant_ppl_needed']; 

    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'id');
    }


    public function applications()
    {
        return $this->hasMany('App\addRequest', 'id', 'activity_id');
    }

    public function sessions()
    {
        return $this->hasMany('App\ActSession', 'id', 'activity_id')->orderBy('date_of_session', 'asc');
    }

    public function events()
    {
        return $this->hasMany('App\ActSession')->orderBy('date_of_session', 'asc');
    }

}
