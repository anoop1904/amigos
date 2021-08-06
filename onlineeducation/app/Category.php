<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
	protected $table = "tbl_category";
    protected $guarded = [];


    public function category_name(){
        return $this->belongsTo('App\Category', 'parent_id', 'id')->withTrashed();
    }
}


