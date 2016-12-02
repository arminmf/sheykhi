<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_members extends Model
{
    protected $table = 'event_members';
    public $timestamps = false;
    public $fillable = ['id','event_id','user_id'];
}
