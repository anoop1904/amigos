<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
	use SoftDeletes;
	protected $table = "tbl_store";
    protected $guarded = [];
	
	
    public function checkcategory(){
		
        return $this->hasMany('App\StoreCategoryMaping', 'store_id', 'id')->withTrashed();
    }
	
	
}


