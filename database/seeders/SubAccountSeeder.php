<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubAccountSeeder extends Seeder
{
    public function run(): void
    {
        Sub::create([
            'name' => '',
            'user_id' => User::find(1),
            'group_id' => '',
            'sub' => '',
            'payments' => '',
            'unPayments' => '',
            'accruals' => '',
        ]);
    }
}
