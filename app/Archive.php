<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Archive extends Model
{
    protected $table = 'archive';
    protected $fillable =  ['email_subject', 'rec_name', 'rec_email', 'message'];
}
