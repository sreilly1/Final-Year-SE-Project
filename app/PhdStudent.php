<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhdStudent extends Model
{
    protected $table = 'phd_students';
    protected $fillable =  ['id', 'user_id','student_id','supervisor_id','year_of_study'];
    public function users()
    {
        return $this->hasMany('App\UserMod', 'id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo('App\UserMod', 'user_id', 'id');
    }
    public function supervisor()
    {
        return $this->belongsTo('App\UserMod', 'supervisor_id', 'id');
    }
    public function requests()
    {
        return $this->hasMany('App\AddRequest', 'user_id', 'user_id');
    }
}
