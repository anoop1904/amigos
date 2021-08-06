<?php

namespace App;
use App\Store;
use App\Plan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherCourseMapping extends Model
{
	//use SoftDeletes;
	protected $table = "teacher_course_mapping"; 
    protected $guarded = [];
    //

}
