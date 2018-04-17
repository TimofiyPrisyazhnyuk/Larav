<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'password','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


//    public function roles()
//    {
//        return $this->hasOne('App\Role','user_id','id');
//    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function products()
    {
        return $this->hasMany('App\Product');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role','role_user','user_id','role_id');
    }
    
    
    
    
    
}