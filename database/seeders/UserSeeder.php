<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Заполнит базу тестовым пользователем
         *
        */
        User::updateOrCreate(['email' => 'forest@gmail.com'], [
            'name' => 'MainTest',
            'email' => 'forest@gmail.com',
            'referral_percent' => 1,
            'referral_discount' => 0,
            'password' => bcrypt('12345678'),
        ])->assignRole('referrer');

        User::updateOrCreate(['email' => 'referral@gmail.com'], [
            'name' => 'Referral',
            'email' => 'referral@gmail.com',
            'referrer_id' => 1,
            'referral_percent' => 1,
            'referral_discount' => 0,
            'password' => bcrypt('12345678'),
        ]);
    }
}
