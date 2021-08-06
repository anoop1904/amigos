<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "tbl_question_answer";
    protected $guarded = [];

    public function customer_detail(){
        return $this->belongsTo('App\User', 'from_user','id')->withTrashed();
    }
}

