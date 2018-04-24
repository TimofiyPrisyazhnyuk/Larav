<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{

    /**
     * @var string
     */
    protected $table = 'role_user';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id',
    ];

}
