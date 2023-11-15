<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Dto\Sub\TransformSubData;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;
use App\Utils\Helper;

final readonly class SubService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $dataTransformer,
    ) {
    }

    public function handleSub(Sub $sub): TransformSubData
    {
        $remoteSub = $this->client->getSub(groupId: $sub->group_id);
        $workers = $sub->workers;

        $remoteSub->concat([
            'today_forecast' => $this->todayForecast(
                hashPerDay: $sub->hash_rate,
                fee: config('api.btc.fee') + $sub->allbtc_fee
            ),
            'last_month_amount' => $sub->lastMonthIncomes()->sum('daily_amount'),
            'workers_count_active' => $workers
                ->where('status', 'ACTIVE')
                ->count(),
            'workers_count_inactive' => $workers
                ->where('status', 'INACTIVE')
                ->count(),
            'workers_count_unstable' => $workers
                ->where('status', 'DEAD')
                ->count(),
        ]);

        return $this->dataTransformer->transformSub(
            sub: $sub,
            data: $remoteSub->toArray()
        );
    }

    /**
     * Прогноз дохода на сегодня
     */
    public function todayForecast(float $hashPerDay, float $fee): string
    {
        return number_format(Helper::calculateEarn(
            stats: MinerStat::first(),
            hashRate: $hashPerDay,
            fee: $fee
        ), 8, '.', ' ');
    }
}
