<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\SubViewData;
use App\Dto\WorkerData;
use App\Enums\Hash\Unit;
use App\Models\Sub;
use App\Services\External\Contracts\TransformContract;
use App\Utils\HashRateConverter;
use Illuminate\Support\Arr;

class DataTransformer implements TransformContract
{
    public function transformSub(Sub $sub, array $remoteSub): SubViewData
    {
        $hashPerDayPure = $sub->hash_rate;
        $hashPerMinPure = (int) Arr::get($remoteSub, 'shares_1m_pure', 0);

        $hashPerMin = HashRateConverter::fromPure($hashPerMinPure);
        $hashPerDay = HashRateConverter::fromPure($hashPerDayPure);

        return SubViewData::fromArray([
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'group_id' => $sub->group_id,
            'active_workers_count' => $sub->workers->where('status', 'ACTIVE')->count(),
            'inactive_workers_count' => $sub->workers->where('status', 'INACTIVE')->count(),
            'dead_workers_count' => $sub->workers->where('status', 'DEAD')->count(),
            'hash_per_min_pure' => $hashPerMinPure,
            'hash_per_min' => (float) $hashPerMin->value,
            'hash_per_min_unit' => $hashPerMin->unit,
            'hash_per_day_pure' => (int) $hashPerDayPure,
            'hash_per_day' => (float) $hashPerDay->value,
            'hash_per_day_unit' => $hashPerDay->unit,
            'pending_amount' => (float) $sub->pending_amount,
            'total_payout' => (float) $sub->total_payout,
            'total_amount' => (float) $sub->total_amount,
            'yesterday_amount' => (float) $sub->yesterday_amount,
            'today_forecast' => (float) $sub->todayForecast($sub->hash_rate,
                config('api.btc.fee') + $sub->allbtc_fee
            ),
            'last_month_amount' => (float) $sub->lastMonthIncomes()->sum('daily_amount'),
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
                value: (float) Arr::get($remoteWorker, 'shares_1d', 0),
                unit: Unit::tryFrom(Arr::get($remoteWorker, 'shares_1d_unit', 'T'))
            )->value,
            'unit_per_day' => Arr::get($remoteWorker, 'shares_1d_unit', 'T'),
            'hash_per_min' => Arr::get($remoteWorker, 'shares_1m_pure', 0),
            'unit_per_min' => Arr::get($remoteWorker, 'shares_unit', 'T'),
            'pool_data' => $remoteWorker,
        ]);
    }
}
