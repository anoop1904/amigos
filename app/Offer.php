<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
	use SoftDeletes;
	protected $table = "tbl_offer";
    protected $guarded = [];

    public function getMetaAttribute()
    {
	    if($this->coupon_type ==1){
			$meta = Store::whereIn('id', explode(",", $this->store_ids))->pluck('name');
		}else{
			$meta = Product::whereIn('id', explode(",", $this->store_ids))->pluck('name');	
		}
        return $meta;
    }

    public function getStores()
    {
	    if($this->coupon_type ==1){
			$stores = Store::whereIn('id', explode(",", $this->store_ids))->get();
		}
        return $stores;
    }
}


