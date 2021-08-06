<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kitchen extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "kitchen_establishment_info";
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
    // public function org(){
    //     return $this->belongsTo('App\Organizationmaster', 'OrgID', 'id');
    // }

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // public function setPasswordAttribute($password)
    // {   
    //     $this->attributes['password'] = bcrypt($password);
    // }
    
    // public function getLanguagesAttribute()
    // {
    //     $languages = Language_master::withTrashed()->whereIn('id', explode(",", $this->language_known))->pluck('name');
    //     return $languages;
    // }
}
