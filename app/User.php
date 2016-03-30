<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The sessions that belong to the user.
     */

    //add s0me inf0 fr0m: https://laravel.com/docs/master/eloquent-relationships#many-to-many
    public function sessions() {
        return $this->belongsToMany('App\Session');
    }
}
