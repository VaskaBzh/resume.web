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
        ];
    }
}
