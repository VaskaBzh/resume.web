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

        dd($remoteSub->get('shares_1m_pure'));

        $remoteSub->concat([
            'today_forecast' => $this->todayForecast(
                hashPerDay: $sub->hash_rate,
                fee: config('api.btc.fee') + $sub->allbtc_fee
            ),
            'last_month_amount' => $sub->lastMonthIncomes()->sum('daily_amount'),
            'hash_per_day' => $hashPerDay->value,
            'hash_per_day_unit' => $hashPerDay->unit,
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
