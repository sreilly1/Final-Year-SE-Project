<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AddModule extends Model{
	protected $table = 'modules';
	protected $fillable =  ['module_name', 'module_code', 'module_leader'];
	

    
}
