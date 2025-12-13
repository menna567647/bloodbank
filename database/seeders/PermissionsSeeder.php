<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $permissions = [
            // users
            'users' => [
                'create users',
                'read users',
                'update users',
                'delete users',
                'active users',
                'deactive users',
            ],

            // bloodtypes
            'bloodtypes' => [
                'create bloodtypes',
                'read bloodtypes',
                'update bloodtypes',
                'delete bloodtypes',
            ],

            // governorates
            'governorates' => [
                'create governorates',
                'read governorates',
                'update governorates',
                'delete governorates',
            ],

            // cities
            'cities' => [
                'create cities',
                'read cities',
                'update cities',
                'delete cities',
            ],

            // categories
            'categories' => [
                'create categories',
                'read categories',
                'update categories',
                'delete categories',
            ],

            // clients
            'clients' => [
                'create clients',
                'read clients',
                'update clients',
                'delete clients',
            ],

            // donations
            'donations' => [
                'create donations',
                'read donations',
                'update donations',
                'delete donations',
            ],

            // messages
            'messages' => [
                'create messages',
                'read messages',
                'update messages',
                'delete messages',
            ],

            // posts
            'posts' => [
                'create posts',
                'read posts',
                'update posts',
                'delete posts',
            ],

            // roles
            'roles' => [
                'create roles',
                'read roles',
                'update roles',
                'delete roles',
            ]
        ];

        foreach ($permissions as $group => $permissionList) {
            foreach ($permissionList as $permissionName) {
                $permission = Permission::updateOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                    'group' => $group,
                ]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
