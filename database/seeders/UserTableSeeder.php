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
            'name' => 'Karyawan Pertama',
            'email' => 'emp@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $emp->assignRole($employeeRole);

        $emp2 = User::create([
            'name' => 'Karyawan Kedua',
            'email' => 'emp2@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $emp2->assignRole($employeeRole);

        $emp3 = User::create([
            'name' => 'Karyawan Ketiga',
            'email' => 'emp3@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $emp3->assignRole($employeeRole);

        $user = User::create([
            'name' => 'User Pertama',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($userRole);

        $user2 = User::create([
            'name' => 'User Kedua',
            'email' => 'user2@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user2->assignRole($userRole);

        $user3 = User::create([
            'name' => 'User Ketiga',
            'email' => 'user3@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user3->assignRole($userRole);

        $user4 = User::create([
            'name' => 'User Keempat',
            'email' => 'user4@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user4->assignRole($userRole);

        $user5 = User::create([
            'name' => 'User Kelima',
            'email' => 'user5@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user5->assignRole($userRole);

        /**
         * semua permission untuk admin
         */
        $adminPermissions = [
            'dashboard.view',
            'announcement.view',
            'announcement.store',
            'announcement.edit',
            'announcement.delete',
            'produk.view',
            'produk.store',
            'produk.edit',
            'produk.delete',
            'history.view',
            'todos.view',
            'todos.store',
            'todos.edit',
            'todos.delete',
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
            'todos.view',
            'todos.store',
            'todos.edit',
            'todos.delete',
            'profile.view',
            'profile.edit',
        ];
        $employeeRole->syncPermissions($empPermissions);
    }
}
