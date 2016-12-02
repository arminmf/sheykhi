<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    public $timestamps = false;
    public $fillable = ['author_id','title','des','time','lat','log','location','tarikh','fadate','keywords'];
}
