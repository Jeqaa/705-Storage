<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ActiveRolesController extends Controller
{
    public function viewActiveRoles()
    {
        $roles = Role::all();
        return view('role_management.active_roles.view_active_roles', compact('roles'));
    }

    public function editActiveRoles($id)
    {
        $role = Role::findORFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view(
            'role_management.active_roles.edit_active_roles',
            compact('role', 'permissions', 'permission_groups')
        );
    }

    // update permission untuk role
    public function updateActiveRoles(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]); // jika tidak ada permission yang dipilih, maka hapus semua permission dari role

        }
        return redirect()->route('active.roles.view')->with([
            'message' => 'Permission dari Role ' . $role->name . ' berhasil diperbarui.',
            'alert-type' => 'success'
        ]);
    }

    // delete role
    public function deleteActiveRoles($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return redirect()->route('active.roles.view')->with('success', 'Role berhasil dihapus');
    }
}
