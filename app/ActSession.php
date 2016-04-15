<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ActSession extends Model{

	protected $table = 'sessions';
	protected $fillable =  ['activity_id', 'date_of_session', 'start_time', 'end_time', 'location']; 

    public function activity()
    {
        return $this->belongsTo('App\Activity', 'activity_id', 'id');
    }
}
