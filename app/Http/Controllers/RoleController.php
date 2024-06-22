<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function allRoles()
    {
        $roles = Role::all();
        return view('roles.all_roles', compact('roles'));
    }

    public function storeRoles(Request $request)
    {
        Role::create([
            'name' => $request->nama_role,
        ]);
        return redirect()->route('all.roles')->with('success', 'Role berhasil ditambahkan');
    }

    public function editRoles($id)
    {
        $roles = Role::findOrFail($id);
        return view('roles.edit_roles', compact('roles'));
    }

    public function updateRoles(Request $request)
    {
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->nama_role,
        ]);
        return redirect()->route('all.roles')->with('success', 'Role berhasil diupdate');
    }

    public function deleteRoles($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('all.roles')->with('success', 'Role berhasil dihapus');
    }
}
