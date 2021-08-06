<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Likes extends Model
{
	use SoftDeletes;
	protected $table = "tbl_likes";
    protected $guarded = [];
}


