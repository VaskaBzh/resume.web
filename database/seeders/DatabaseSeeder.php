<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SubAccountSeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(HashSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(IncomeSeeder::class);
        $this->call(PayoutSeeder::class);
    }
}
