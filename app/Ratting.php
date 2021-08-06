<?php

namespace App;

use App\Customer;
use App\Store;
use App\OrderDetail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ratting extends Model
{
	use SoftDeletes;
	protected $table = "tbl_ratting";
    protected $guarded = [];

}


