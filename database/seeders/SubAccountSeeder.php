<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sub;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Database\Seeder;

class SubAccountSeeder extends Seeder
{
    public function run(): void
    {
        Sub::updateOrcreate([
            'group_id' => 6001912,
        ], [
            'user_id' => User::whereEmail('forest@gmail.com')->first()->id,
            'group_id' => 6001912,
            'sub' => 'MainTest',
        ]);

        Sub::updateOrcreate([
            'group_id' => 9999999,
        ], [
            'user_id' => User::whereEmail('referral@gmail.com')->first()->id,
            'group_id' => 9999999,
            'sub' => 'Referral',
        ]);
    }
}
