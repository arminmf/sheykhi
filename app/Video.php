<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    public $timestamps = false;
    public $fillable = ['title','des','img','link_video','link_video2','link_video3','cat','keywords','voice'];
}
