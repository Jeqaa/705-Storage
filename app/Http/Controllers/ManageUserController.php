<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManageUserController extends Controller
{
    public function viewUsers()
    {
        $users = User::all();
        return view('manage_users.view_manage_users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('manage_users.edit_manage_users', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {

        $existingEmail = User::where('email', $request->email)->first();

        // jika email sudah ada di database
        if ($existingEmail && $existingEmail->id != $id) {
            return redirect()->route('manage-users.view')->with([
                'message' => 'Email ' . $request->email . ' sudah ada.',
                'alert-type' => 'error'
            ]);
        }
        $user = User::findOrFail($id);
        $user->name = $request->nama_user;
        $user->email = $request->email;

        $user->save();
        $user->roles()->detach();

        if ($request->nama_role) {
            $user->assignRole($request->nama_role);
        }

        return redirect()->route('manage-users.view')->with([
            'message' => 'User berhasil diperbarui.',
            'alert-type' => 'success'
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return redirect()->route('manage-users.view')->with([
            'message' => 'User berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}