<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
	use SoftDeletes;
	protected $table = "tbl_search_entry";
    protected $guarded = [];
}


