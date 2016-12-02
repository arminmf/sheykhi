<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Up extends Model
{
    protected $table = 'users_post';
    public $timestamps = false;
    public $fillable = ['id','title','user_id','text','title','time','img'];
}
