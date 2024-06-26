<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            // Announcement Group
            ['name' => 'announcement.view', 'group_name' => 'announcement'],
            ['name' => 'announcement.store', 'group_name' => 'announcement'],
            ['name' => 'announcement.edit', 'group_name' => 'announcement'],
            ['name' => 'announcement.delete', 'group_name' => 'announcement'],

            // Dashboard Group
            ['name' => 'dashboard.view', 'group_name' => 'dashboard'],

            // Product Group
            ['name' => 'produk.view', 'group_name' => 'produk'],
            ['name' => 'produk.store', 'group_name' => 'produk'],
            ['name' => 'produk.edit', 'group_name' => 'produk'],
            ['name' => 'produk.delete', 'group_name' => 'produk'],

            // History Group
            ['name' => 'history.view', 'group_name' => 'history'],

            // Todos Group
            ['name' => 'todos.view', 'group_name' => 'todos'],
            ['name' => 'todos.store', 'group_name' => 'todos'],
            ['name' => 'todos.edit', 'group_name' => 'todos'],
            ['name' => 'todos.delete', 'group_name' => 'todos'],

            // Role Management Group
            ['name' => 'role.management.menu', 'group_name' => 'role_management'],
            ['name' => 'permission.view', 'group_name' => 'role_management'],
            ['name' => 'permission.store', 'group_name' => 'role_management'],
            ['name' => 'permission.edit', 'group_name' => 'role_management'],
            ['name' => 'permission.delete', 'group_name' => 'role_management'],
            ['name' => 'roles.view', 'group_name' => 'role_management'],
            ['name' => 'roles.store', 'group_name' => 'role_management'],
            ['name' => 'roles.edit', 'group_name' => 'role_management'],
            ['name' => 'roles.delete', 'group_name' => 'role_management'],
            ['name' => 'active.roles.view', 'group_name' => 'role_management'],
            ['name' => 'active.roles.edit', 'group_name' => 'role_management'],
            ['name' => 'active.roles.delete', 'group_name' => 'role_management'],

            // User Management Group
            ['name' => 'user.management.view', 'group_name' => 'user_management'],
            ['name' => 'user.management.edit', 'group_name' => 'user_management'],
            ['name' => 'user.management.delete', 'group_name' => 'user_management'],

            // Profile Group
            ['name' => 'profile.view', 'group_name' => 'profile'],
            ['name' => 'profile.edit', 'group_name' => 'profile'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
