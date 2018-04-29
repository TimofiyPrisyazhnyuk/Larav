<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    /**
     * @param $id
     * @return array|bool
     */
    public function checkPermission(int $id)
    {
        $permissionsUser = [];
        $user = User::getUserToId($id);
        $permissions = Permission::all();
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
