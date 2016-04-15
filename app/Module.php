<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{


	protected $table = 'modules';
	protected $fillable =  ['module_name', 'module_code', 'module_leader'];

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function user()
    {
        return $this->belongsTo('App\UserMod', 'module_leader', 'id');
    }

}

