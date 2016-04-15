<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AddActivity extends Model{
	protected $table = 'activities';
	protected $fillable =  ['title', 'role_type', 'module_id','quant_ppl_needed'];
}
