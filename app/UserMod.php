<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMod extends Model
{

	protected $table = 'users';
	protected $fillable =  ['id', 'username','title', 'name', 'email', 'phone_number', 'role'];


    public function phds()
    {
        return $this->hasMany('App\PhDStudent', 'id');
    }

    public function module()
    {
        return $this->hasMany('App\Module', 'module_leader', 'id');
    }


}



