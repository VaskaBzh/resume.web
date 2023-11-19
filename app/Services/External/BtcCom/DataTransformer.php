<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\TransformSubData;
use App\Dto\WorkerData;
use App\Enums\Hash\Unit;
use App\Models\Sub;
use App\Services\External\TransformContract;
use App\Utils\HashRateConverter;
use Illuminate\Support\Collection;

class DataTransformer implements TransformContract
{
    public function transformCollection(Collection $collection, string $itemType): Collection
    {
        $method = 'transform'.class_basename($itemType);

        if (! method_exists($this, $method)) {
            throw new \Exception(sprintf('Transform method %s not found.', $method));
        }

        return $collection->map(static fn (array $item) => static::$method($item));
    }

    public function transformSub(Sub $sub, array $remoteSub): TransformSubData
    {
        $subData = [
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'total_payout' => $sub->total_payout,
            'total_amount' => $sub->total_amount,
            'yesterday_amount' => $sub->yesterday_amount,
        ];

        return TransformSubData::fromArray(array_merge($subData, $remoteSub));
    }

    public static function transformWorker(array $remoteWorker): WorkerData
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
