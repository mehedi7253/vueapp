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
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        // Create Roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Assign Permissions
        $admin->givePermissionTo(['manage users', 'edit product', 'delete product']);
        $editor->givePermissionTo(['edit product']);
    }
}
