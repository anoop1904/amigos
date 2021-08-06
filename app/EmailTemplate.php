<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
	use SoftDeletes;
	protected $table = "tbl_email_template";
    protected $guarded = [];

    // public function getMetaAttribute()
    // {
    //     $meta = Store::whereIn('id', explode(",", $this->store_ids))->pluck('name');
    //     return $meta;
    // }
}


