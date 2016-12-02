<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    public $timestamps = false;
    public $fillable = ['id','img_name','project_id','news_id','vent_id','video_id','main','det'];
}
