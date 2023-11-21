<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(['email' => 'forest@gmail.com'], [
            'name' => 'MainTest',
            'email' => 'forest@gmail.com',
            'referral_percent' => 1,
            'referral_discount' => 0,
            'password' => bcrypt('12345678'),
        ])->assignRole('referrer');

        User::updateOrCreate(['email' => 'referral@gmail.com'], [
            'name' => 'Referral',
            'email' => 'referral@gmail.com',
            'referrer_id' => $user->id,
            'referral_percent' => $user->referral_percent,
            'referral_discount' => $user->referral_discount,
            'password' => bcrypt('12345678'),
        ])->assignRole('referral');
    }
}
