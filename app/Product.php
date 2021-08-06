<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
	use SoftDeletes;
	protected $table = "tbl_product";
    protected $guarded = [];

    public function category_list(){
        return $this->belongsTo('App\Category', 'category_id', 'id')->withTrashed();
    }
    public function sub_category_list(){
        return $this->belongsTo('App\Category', 'sub_category_id', 'id')->withTrashed();
    }
    public function sub_sub_category_list(){
        return $this->belongsTo('App\Category', 'sub_sub_category_id', 'id')->withTrashed();
    }

    public function unit_list(){
        return $this->belongsTo('App\Unit', 'unit_id', 'id')->withTrashed();
    }
}


