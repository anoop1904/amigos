<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videourl extends Model
{
    protected $table = "tbl_course_video";
    protected $guarded = [];

     public function videocomment(){
        
        return $this->hasMany('App\Comment', 'video_id', 'id');
    }
}

