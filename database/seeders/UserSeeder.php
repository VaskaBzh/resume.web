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

        User::create([
            'name' => "admin",
            'email' => 'admin@example.ru',
            'password' => bcrypt('12345678'),
            'groups' => ['MyWorker', 'myWorker', 'login'],
        ]);
    }
}
