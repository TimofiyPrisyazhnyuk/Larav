<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

class HomeUsersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users()
    {
        $userColumnName = User::getColumnNameUser();
        $user = User::getAllUsers();

        return view('home.users.users', [
            'user' => $user,
            'userColumnName' => $userColumnName,
        ]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        if (isset($id)) {
            $user = User::getUserToId($id);
            $role = new Role;
            $permissions = new Permission;

            return view('home.users.updateUser', [
                'user' => $user,
                'role' => $role->getAllRole(),
                'userPermissions' => $permissions->checkPermission($id),
                'userRole' => $role->checkRole($id),
            ]);

        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addRole(Request $request, $id)
    {
        $data = $request->all();
        $addRole = Role::addRole($data, $id);
        if ($addRole == false) {
            return redirect()->back()
                ->with('messageWarning', 'User has this role');
        }
        return redirect()->back()
            ->with('messageSuccess', 'Role added !');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        $user = User::getUserToId($id);
        if (isset($user) && $user->delete()) {

            return redirect()->back()
                ->with('messageSuccess', 'User deleted');
        }
        return redirect()->back()
            ->with('messageWarning', 'Warning! user not deleted');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function deleteRole(Request $request, $id)
    {
        $user = User::getUserToId($id);
        if (isset($user)) {
            $deleteRole = RoleUser::where('user_id', $user->id)
                ->where('role_id', $request->roleId)->delete();
            if ($deleteRole) {

                return redirect()->back()
                    ->with('messageSuccess', 'Role deleted!');
            }
            return redirect()->back()
                ->with('messageWarning', 'Warning! role not deleted ');
        }
        return abort(404);
    }

}
