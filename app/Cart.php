<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	//use SoftDeletes;
	protected $table = "tbl_cart";
    protected $guarded = [];


    public function cart_detail(){
        return $this->hasMany('App\CartDetail', 'cart_id','id');
    }

    public function customer_detail(){
        return $this->belongsTo('App\Customer', 'user_id','id')->withTrashed();
    }

    public function store(){
        return $this->belongsTo('App\Store', 'store_id','id')->withTrashed();
    }
}


