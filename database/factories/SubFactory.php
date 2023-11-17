<?php

namespace Database\Factories;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubFactory extends Factory
{
    protected $model = Sub::class;

    public function definition(): array
    {
        return [
            'user_id' => User::first()->id,
            'group_id' => mt_rand(0, 1000000000000000),
            'sub' => \Str::random(10),
            'allbtc_fee' => 3.5,
        ];
    }
}
