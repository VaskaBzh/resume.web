<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\SubViewData;
use App\Dto\WorkerData;
use App\Enums\Hash\Unit;
use App\Models\Sub;
use App\Services\External\TransformContract;
use App\Utils\HashRateConverter;

class DataTransformer implements TransformContract
{
    public function transformSub(Sub $sub, array $remoteSub): SubViewData
    {
        $hashPerMin = HashRateConverter::fromPure((int) $remoteSub['shares_1m_pure']);
        $hashPerDay = HashRateConverter::fromPure($sub->hash_rate);

        return SubViewData::fromArray([
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'group_id' => $sub->group_id,
            'active_workers_count' => $sub->workers->where('status', 'ACTIVE')->count(),
            'inactive_workers_count' => $sub->workers->where('status', 'INACTIVE')->count(),
            'dead_workers_count' => $sub->workers->where('status', 'DEAD')->count(),
            'hash_per_min' => $hashPerMin->value,
            'hash_per_min_unit' => $hashPerMin->unit,
            'hash_per_day' => $hashPerDay->value,
            'hash_per_day_unit' => $hashPerDay->unit,
            'total_payout' => $sub->total_payout,
            'total_amount' => $sub->total_amount,
            'yesterday_amount' => $sub->yesterday_amount,
            'today_forecast' => $sub->todayForecast($sub->hash_rate,
                config('api.btc.fee') + $sub->allbtc_fee
            ),
            'last_month_amount' => $sub->lastMonthIncomes()->sum('daily_amount'),
        ]);
    }

    public function transformWorker(array $remoteWorker): WorkerData
    {
        return WorkerData::fromArray([
            'group_id' => $remoteWorker['gid'],
            'worker_id' => $remoteWorker['worker_id'],
            'name' => $remoteWorker['worker_name'],
            'status' => $remoteWorker['status'],
            'hash_per_day' => HashRateConverter::toPure(
                value: (float) $remoteWorker['shares_1d'],
                unit: Unit::tryFrom($remoteWorker['shares_1d_unit'])
            )->value,
            'unit_per_day' => $remoteWorker['shares_1d_unit'],
            'hash_per_min' => $remoteWorker['shares_1m_pure'],
            'unit_per_min' => $remoteWorker['shares_unit'],
            'pool_data' => $remoteWorker,
        ]);
    }
}
