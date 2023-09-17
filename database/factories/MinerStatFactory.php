<?php

namespace Database\Factories;

use App\Models\MinerStat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MinerStatFactory extends Factory
{
    protected $model = MinerStat::class;

    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'network_hashrate' => 369.60,
            'network_unit' => 'E',
            'network_difficulty' => 55621444139429,
            'next_difficulty' => 54452584425134,
            'change_difficulty' => '-2.1%',
            'reward_block' => 6.2500000,
            'price_USD' => 26081,
            'time_remain' => 1694024386000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fpps_rate' => 1.76,
=======
            'network_hashrate' => $this->faker->randomFloat(),
            'network_unit' => $this->faker->word(),
            'network_difficulty' => $this->faker->randomNumber(),
            'next_difficulty' => $this->faker->randomNumber(),
            'change_difficulty' => $this->faker->word(),
            'reward_block' => $this->faker->randomFloat(),
            'price_USD' => $this->faker->randomNumber(),
            'time_remain' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fpps_rate' => $this->faker->randomFloat(),
>>>>>>> 060e7a1 (pulled)
        ];
    }
}
