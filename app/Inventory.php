<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
	use SoftDeletes;
	protected $table = "tbl_inventory";
    protected $guarded = [];

    public function store(){
        return $this->belongsTo('App\Store', 'store_id', 'id')->withTrashed();
    }
    public function unit(){
        return $this->belongsTo('App\Unit', 'unit', 'id')->withTrashed();
    }
    public function unit_detail(){
        return $this->belongsTo('App\Unit', 'unit', 'id')->withTrashed();
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id')->withTrashed();
    }

}


