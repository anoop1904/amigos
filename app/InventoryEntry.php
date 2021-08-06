<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryEntry extends Model
{
	use SoftDeletes;
	protected $table = "tbl_inventory_entry";
    protected $guarded = [];
    
    public function store(){
        return $this->belongsTo('App\Store', 'store_id', 'id')->withTrashed();
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id')->withTrashed();
    }
}


