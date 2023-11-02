<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\User\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => Roles::REFERRER->value]);
        Role::firstOrCreate(['name' => Roles::REFERRAL->value]);
        $permission = Permission::firstOrCreate(['name' => 'can attach referrals']);
        $permission->assignRole($role);
    }
}
