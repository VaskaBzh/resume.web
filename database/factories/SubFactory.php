<?php

namespace Database\Factories;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubFactory extends Factory
{
    protected $model = Sub::class;

    public function definition(): array
    {
        $user = User::whereEmail('forest@gmail.com')->first();

        return [
            'group_id' => 666666,
            'sub' => $this->faker->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'percent' => 3.5,
            'pending_amount' => 0,
            'total_amount' => 0,

            'user_id' => $user->id,
        ];
    }
}
