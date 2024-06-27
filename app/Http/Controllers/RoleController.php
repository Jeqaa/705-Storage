<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function viewRoles()
    {
        $roles = Role::all();
        $title = 'Roles - 705 Storage';
        return view('role_management.roles.view_roles', compact('roles', 'title'));
    }

    // simpan nama role
    public function storeRoles(Request $request)
    {
        $role = Role::firstOrCreate(
            ['name' => $request->nama_role],
        );
        if ($role->wasRecentlyCreated) {
            return redirect()->route('roles.view')->with([
                'message' => 'Role ' . $role->name . ' berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('roles.view')->with([
                'message' => 'Role ' . $role->name . ' sudah ada.',
                'alert-type' => 'error'
            ]);
        }
    }

    public function editRoles($id)
    {
        $roles = Role::findOrFail($id);
        $title = 'Edit ' . $roles->name . ' - 705 Storage';
        return view('role_management.roles.edit_roles', compact('roles', 'title'));
    }

    // update nama role (unik)
    public function updateRoles(Request $request)
    {
        $role = Role::findOrFail($request->id);
        // cek apakah nama role baru sama beda role yang sudah ada
        if ($role->name !== $request->nama_role) {
            $existingRole = Role::where('name', $request->nama_role)->first();
            // jika ya maka redirect dan tampilkan alert
            if ($existingRole) {
                return redirect()->route('roles.view')->with([
                    'message' => 'Role ' . $role->name . ' sudah ada.',
                    'alert-type' => 'error'
                ]);
            }
        }
        // update role
        $role->name = $request->nama_role;
        $role->save();
        return redirect()->route('roles.view')->with([
            'message' => 'Role berhasil diperbarui.',
            'alert-type' => 'success'
        ]);
    }

    // hapus role
    public function deleteRoles($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('roles.view')->with([
            'message' => 'Role berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
