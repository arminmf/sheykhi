<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;
    public $fillable = ['author_id','title','des','location','ejra','cat','keywords','voice'];
}
