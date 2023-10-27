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
            'name' => "MainTest",
            'email' => 'forest@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
