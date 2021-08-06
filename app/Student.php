<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Student extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "student";
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function vendor(){
        return $this->belongsTo('App\User', 'vendorUserId', 'id')->withTrashed();
    }
    public function plan_name(){
        return $this->belongsTo('App\Plan', 'plan_id', 'id');
    }

    public function school_detail(){
        return $this->belongsTo('App\School', 'school_id', 'id')->withTrashed();
    }
    public function subscription(){
        return $this->belongsTo('App\Subscription', 'id', 'student_id');
    }
    public function device_detail(){
        return $this->belongsTo('App\Device_Detail', 'id', 'student_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
