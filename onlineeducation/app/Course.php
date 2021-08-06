<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
{
	use SoftDeletes;
	protected $table = "tbl_course";
    protected $guarded = [];

    public function category_list(){
        return $this->belongsTo('App\Category', 'category_id', 'id')->withTrashed();
    }
    public function sub_category_list(){
        return $this->belongsTo('App\Category', 'sub_category_id', 'id')->withTrashed();
    }
   
    public function videourl(){
        
        return $this->hasMany('App\Videourl', 'course_id', 'id');
    }
}


