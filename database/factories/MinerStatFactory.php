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
            'network_hashrate' => 449.01,
            'network_unit' => 'E',
            'network_difficulty' => 61030681983175,
            'next_difficulty' => 0,
            'change_difficulty' => 0,
            'reward_block' => 6.2500000,
            'price_USD' => 34668,
            'time_remain' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fpps_rate' => 4.77,
        ];
    }
}

/**
 * id
 * network_hashrate
 * network_unit
 * network_difficulty
 * next_difficulty
 * change_difficulty
 * reward_block
 * fpps_rate
 * price_USD
 * time_remain
 * created_at
 * updated_at
 */
