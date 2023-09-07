<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::create(['name' => 'referral']);
        $permission = Permission::create(['name' => 'can be a referral']);
        $permission->assignRole($role);
    }
}