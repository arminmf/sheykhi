<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table = 'cat';
    public $timestamps = false;
    public $fillable = ['name','parent','post_type'];
}
