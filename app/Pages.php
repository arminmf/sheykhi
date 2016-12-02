<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    public $timestamps = false;
    public $fillable = ['title','des','time','eng_name','keywords'];
}
