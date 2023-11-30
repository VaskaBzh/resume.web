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
            'network_hashrate' => 546.49,
            'network_unit' => 'E',
            'network_difficulty' => 62463471666732,
            'next_difficulty' => 0,
            'change_difficulty' => 0,
            'reward_block' => 6.2500000,
            'price_USD' => 35120,
            'time_remain' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fpps_rate' => 7.49,
        ];
    }
}
