<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'SuperAdmin']);
        Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Manager']);
        Role::create(['name'=>'User']);

        $permission = Permission::create(['name' => 'AdminPanel access']);
        $permission->assignRole('Admin');
        $permission->assignRole('Manager');

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission delete']);
    }
}
