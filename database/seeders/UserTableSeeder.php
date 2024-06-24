<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole($adminRole);

        $emp = User::create([
            'name' => 'Karyawan',
            'email' => 'emp@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $emp->assignRole($employeeRole);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($userRole);

        /**
         * semua permission untuk admin
         */
        $adminPermissions = [
            'dashboard.view',
            'produk.view',
            'produk.store',
            'produk.edit',
            'produk.delete',
            'history.view',
            'todo.view',
            'todo.store',
            'todo.edit',
            'todo.delete',
            'role.management.menu',
            'permission.view',
            'permission.store',
            'permission.edit',
            'permission.delete',
            'roles.view',
            'roles.store',
            'roles.edit',
            'roles.delete',
            'active.roles.view',
            'active.roles.edit',
            'active.roles.delete',
            'user.management.view',
            'user.management.edit',
            'user.management.delete',
            'profile.view',
            'profile.edit',
        ];
        $adminRole->syncPermissions($adminPermissions);


        /**
         * permission untuk karyawan
         */
        $empPermissions = [
            'dashboard.view',
            'produk.view',
            'produk.store',
            'produk.edit',
            'produk.delete',
            'history.view',
            'todo.view',
            'todo.store',
            'todo.edit',
            'todo.delete',
            'profile.view',
            'profile.edit',
        ];
        $employeeRole->syncPermissions($empPermissions);
    }
}
