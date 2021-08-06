<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
	use SoftDeletes;
	protected $table = "tbl_order_detail";
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id')->withTrashed();
    }
	
	 public function unit(){
        return $this->belongsTo('App\Unit', 'unit', 'id')->withTrashed();
    }
  
	
}


