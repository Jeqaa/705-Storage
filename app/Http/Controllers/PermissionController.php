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
        $permission = Permission::firstOrCreate(
            ['name' => $request->nama_permission],
            ['group_name' => $request->nama_group]
        );
        if ($permission->wasRecentlyCreated) {
            return redirect()->route('permission.view')->with([
                'message' => 'Permission ' . $permission->name . ' berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('permission.view')->with([
                'message' => 'Permission ' . $permission->name . ' sudah ada.',
                'alert-type' => 'error'
            ]);
        }
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('role_management.permission.edit_permission', compact('permission'));
    }

    public function updatePermission(Request $request)
    {
        $permission = Permission::findOrFail($request->id);
        // cek apakah nama permission baru sama beda permission yang sudah ada
        if ($permission->name !== $request->nama_permission) {
            $existingPermission = Permission::where('name', $request->nama_permission)->first();
            // jika ya maka redirect dan tampilkan alert
            if ($existingPermission) {
                return redirect()->route('permission.view')->with([
                    'message' => 'Permission ' . $permission->name . ' sudah ada.',
                    'alert-type' => 'error'
                ]);
            }
        }
        // update permission
        $permission->name = $request->nama_permission;
        $permission->group_name = $request->nama_group;
        $permission->save();
        return redirect()->route('permission.view')->with([
            'message' => 'Permission berhasil diperbarui.',
            'alert-type' => 'success'
        ]);
    }

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('permission.view')->with([
            'message' => 'Permission berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
