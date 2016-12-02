<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class A_filters extends Model
{
    protected $table = 'a_filters';
    public $timestamps = false;
    public $fillable = ['id','p_id','f_id'];
}
