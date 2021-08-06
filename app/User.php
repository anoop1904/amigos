<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type','CreatedBy','name', 'email','password','Phone','Designation','RoleID','UpdatedBy','IsVerify','IsAvailable'
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function studio_detail(){
        return $this->belongsTo('App\Studio', 'studio_id', 'id')->withTrashed();
    }
    public function org(){
        return $this->belongsTo('App\Organizationmaster', 'OrgID', 'id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }
    
    public function getLanguagesAttribute()
    {
        $languages = Language_master::withTrashed()->whereIn('id', explode(",", $this->language_known))->pluck('name');
        return $languages;
    }
     public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getDetliveryBoy($userType,$createdby,$name){
        if($createdby==1){
            return "Amigos";
        }else{
            $name = \App\User::withTrashed()->where('id',$createdby)->pluck('name');
            return $name[0];
        }
      
    }
}
