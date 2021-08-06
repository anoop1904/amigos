<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
	use SoftDeletes;
	protected $table = "tbl_search_history";
    protected $guarded = [];

    // public function store(){
    //     return $this->belongsTo('App\Store', 'store_id', 'id')->withTrashed();
    // }

    public function product(){
        return $this->belongsTo('App\Product', 'item_id', 'id')->withTrashed();
    }

    public function store(){
        return $this->belongsTo('App\Store', 'item_id', 'id')->withTrashed();
    }
    public function category(){
        return $this->belongsTo('App\Category', 'item_id', 'id')->withTrashed();
    }

    public function customer(){
        return $this->belongsTo('App\Customer', 'user_id', 'id')->withTrashed();
    }

}


