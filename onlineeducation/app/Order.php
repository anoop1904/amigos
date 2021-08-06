<?php

namespace App;

use App\Customer;
use App\Store;
use App\OrderDetail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	protected $table = "tbl_order";
    protected $guarded = [];


     public function order_detail(){
		 $order = OrderDetail::where('id',$this->id)->count();
		 return $order;
    }
	
	  public function user_detail(){
		 $user = Customer::whereId($this->id)->value('name');
		 return $user;
    }
	

    public function customer_detail(){
		//$meta = Store::whereIn('id', explode(",", $this->store_ids))->pluck('name');
        //return $this->belongsTo('App\Customer', 'user_id','id')->withTrashed();
        return "";
	}

    public function store(){
       return Store::whereId($this->store_id)->value('name');
	}
	public function order_Count(){
       return OrderDetail::where('order_id',$this->id)->count();
	}
	public function delivery_boy(){
       return User::whereId($this->assign_to)->value('name');
	}
}


