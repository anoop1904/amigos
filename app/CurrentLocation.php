<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentLocation extends Model
{
	protected $table = "current_location";
    protected $guarded = [];
}


