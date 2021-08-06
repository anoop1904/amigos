<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
	protected $table = "tbl_cart_detail";
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id')->withTrashed();
    }

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id')->withTrashed();
    }

    public function store(){
        return $this->belongsTo('App\Store', 'store_id')->withTrashed();
    }
}


