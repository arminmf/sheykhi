<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cm extends Model
{
    protected $table = 'comment';
    public $timestamps = false;
    public $fillable = ['id','name','comment_text','replay_to','post_type','post_id','accept','email'];
}
