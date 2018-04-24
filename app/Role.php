<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    /**
     * @return bool|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllRole()
    {
        $role = Role::all();
        return (isset($role)) ? $role : false;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function checkRole($id)
    {
        $roleUser = [];
        $user = User::getUserToId($id);
        $role = $this->getAllRole();
        if ($role != false) {
            foreach ($role as $item) {
                if ($user->hasRole($item->name)) {
                    $roleUser[] = $item;
                }
            }
            return $roleUser;
        }
        return false;
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public static function addRole($data, $id)
    {
        $user = User::getUserToId($id);
        if ($user->hasRole($data['role'])) {
            return false;
        } else {
            $role = Role::where('name', $data['role'])->get();
            foreach ($role as $item) {
                $user->roles()->attach($item->id);
            }
            return true;
        }
    }


}
