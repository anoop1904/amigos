<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websitesetting extends Model
{
    protected $fillable = [
        'website_name','website_logo', 'locktimeout','email', 'address','mobile','rssfeed','fb_link','twi_link','yout_link','ambassador_plan'
    ];
}
