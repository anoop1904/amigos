<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
	use SoftDeletes;
	protected $table = "plans";
    protected $guarded = [];
	
	/*
    public function checkcategory(){
		
        return $this->hasMany('App\StoreCategoryMaping', 'store_id', 'id')->withTrashed();
    } 
	*/
	
	
}


