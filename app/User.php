<?php

namespace App;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'password',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product','user_id','id');
    }

    /**
     * @return bool
     */
    public static function getAuthUser()
    {
        $user = User::where('name', Auth::user()->name)->get();
        foreach ($user as $us) {
            return ($us) ? $us : false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function getUserToId(int $id)
    {
        $user = User::where('id', $id)->get();
        foreach ($user as $us) {
            return ($us) ? $us : false;
        }
    }

    /**
     * @return array
     */
    public static function getColumnNameUser()
    {
        $userColumnName = [];
        $column = User::first();
        if (isset($column)) {
            foreach ($column->fillable as $key => $val) {
                $userColumnName[] = $val;
            }
            return $userColumnName;
        }

    }

    /**
     * @return array|bool
     */
    public static function getAllUsers()
    {
        $getUsers = [];
        $user = User::all();
        if (isset($user)) {
            foreach ($user as $us) {
                $getUsers[] = $us;
            }
            return $getUsers;
        }
        return false;
    }

}
