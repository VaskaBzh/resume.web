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
        Sub::updateOrcreate([
            'group_id' => 6001912,
        ],[
            'user_id' => User::whereEmail('forest@gmail.com')->id,
            'group_id' => 6001912,
            'sub' => 'MainTest',
        ]);
    }
}
