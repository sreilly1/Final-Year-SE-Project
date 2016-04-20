<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MakeUser extends Model{
	protected $table = 'users';
	protected $fillable =  ['id', 'username', 'password', 'title', 'name', 'email','phone_number','room_number', 'role'];
}
