<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
	use SoftDeletes;
	protected $table = "tbl_brand";
    protected $guarded = [];

    public function category_list(){
        return $this->belongsTo('App\Category', 'category_id', 'id')->withTrashed();
    }
}


