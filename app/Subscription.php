<?php

namespace App;
use App\Store;
use App\Plan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
	//use SoftDeletes;
	protected $table = "subscription"; 
    protected $guarded = [];
    //

     public function store(){
     return $this->belongsTo('App\Store', 'store_id', 'id')->where(['IsActive'=>1])->withTrashed();
    }

    public function plan(){
        return $this->belongsTo('App\Plan', 'plan_id', 'id')->withTrashed();
    }
    public function getStore(){
        return $this->belongsTo('App\Store', 'store_id', 'user_id')->withTrashed();
    }
}
