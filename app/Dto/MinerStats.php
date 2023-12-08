<?php

declare(strict_types=1);

namespace App\Dto;

use App\Utils\HashRateConverter;
use Illuminate\Support\Collection;

class MinerStats
{
    public function __construct(
        public int $time_remain,
        public string $network_unit,
        public int $next_difficulty,
        public int $change_difficulty,
        public float $fpps_rate,
        public float $network_hashrate,
        public int $network_difficulty,
        public float $reward_block,
        public float $price_USD,
    ) {
    }

    public static function fromResponse(Collection $imports): MinerStats
    {
        return new self(
            time_remain: $imports['time_remain'],
            network_unit: $imports['network_unit'],
            next_difficulty: $imports['next_difficulty'],
            change_difficulty: $imports['change_difficulty'],
            fpps_rate: $imports['fpps_rate'],
            network_hashrate: (float) HashRateConverter::fromPure($imports['network_hashrate'])->value,
            network_difficulty: (int) $imports['network_difficulty'],
            reward_block: $imports['reward_block'],
            price_USD: $imports['price_USD']
        );
    }
}
