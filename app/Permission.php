<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    /**
     * @return bool|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPermission()
    {
        $permission = Permission::all();
        return (isset($permission)) ? $permission : false;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function checkPermission($id)
    {
        $permissionsUser = [];
        $user = User::getUserToId($id);
        $permissions = $this->getPermission();
        if ($permissions != false) {
            foreach ($permissions as $item) {
                if ($user->can($item->name)) {
                    $permissionsUser[] = $item->name;
                }
            }
            return $permissionsUser;
        }
        return false;
    }


}
