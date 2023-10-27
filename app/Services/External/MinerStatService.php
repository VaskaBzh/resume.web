<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\MinerStat\Upsert;
use App\Models\MinerStat;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MinerStatService
{
    private static array $urls = [
        'network_hashrate' => 'https://blockchain.info/q/hashrate',
        'network_difficulty' => 'https://blockchain.info/q/getdifficulty',
        'reward_block' => 'https://blockchain.info/q/bcperblock',
        'price_USD' => 'https://blockchain.info/q/24hrprice',
    ];

    private function call(string $url): ?string
    {
        return Http::get($url)
            ->throwIf(static fn($response) => $response->failed())
            ->body();
    }

    private function import(): ?Collection
    {
        $stats = [
            'fpps_rate' => resolve(BtcComService::class)->getFppsRate(),
            'network_hashrate' => (float) number_format(
                (int) $this->call(self::$urls['network_hashrate']) / 1000000000,
                2,
                '.',
                ''
            ),
            'network_difficulty' => (int)$this->call(self::$urls['network_difficulty']),
            'reward_block' => (float) number_format(
                (float) $this->call(self::$urls['reward_block']),
                7, '.'
                , ' '),
            'price_USD' => (int) $this->call(self::$urls['price_USD'])
        ];


        return $this->filter($stats);
    }

    public function store(): ?MinerStat
    {
        $stats = $this->import();

        if (!is_null($stats)) {
            return Upsert::execute(stats: $stats);
        }

        return null;
    }

    private function filter(array $stats): Collection
    {
        $stats = collect($stats)->filter();

        if (!Arr::has($stats, array_keys(self::$urls))) {
            throw new \Exception('Mining stats request is empty');
        }

        return $stats;
    }
}
