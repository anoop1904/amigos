<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCategoryMaping extends Model
{
	use SoftDeletes;
	protected $table = "tbl_store_category_maping"; 
    protected $guarded = [];


}


