<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function redirectToPermission()
    {
        return redirect()->route('permission.view');
    }

    public function viewPermission()
    {
        $permissions = Permission::all();
        return view('role_management.permission.view_permission', compact('permissions'));
    }

    public function storePermission(Request $request)
    {
        Permission::create([
            'name' => $request->nama_permission,
            'group_name' => $request->nama_group,
        ]);
        return redirect()->route('permission.view')->with('success', 'Permission berhasil ditambahkan');
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('role_management.permission.edit_permission', compact('permission'));
    }

    public function updatePermission(Request $request)
    {
        $permission_id = $request->id;
        Permission::findOrFail($permission_id)->update([
            'name' => $request->nama_permission,
            'group_name' => $request->nama_group,
        ]);
        return redirect()->route('permission.view')->with('success', 'Permission berhasil diupdate');
    }

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('permission.view')->with('success', 'Permission berhasil dihapus');
    }
}
