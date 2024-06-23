<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class AssignPermissionController extends Controller
{
    public function viewAssignPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view(
            'role_management.assign_permission.add_roles_permission',
            compact('roles', 'permissions', 'permission_groups')
        );
    }

    public function rolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->input('permission');
        foreach ($permissions as $key => $value) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $value;
            DB::table('role_has_permissions')->insert($data);
        }

        return redirect()->route('assign.permission.view')->with('success', 'Role permission berhasil ditambahkan');
    }
}
