<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\TransformSubData;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\Worker;
use App\Services\External\TransformContract;
use Illuminate\Support\Collection;

class DataTransformer implements TransformContract
{
    public function transformSub(Sub $sub, array $data): TransformSubData
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

        return TransformSubData::fromArray(data: array_merge($subData, $data));
    }

    public function transformCollection(Collection $collection, string $className): Collection
    {
        return $collection->map(function (array $item) use ($className) {

            $method = 'transform'.class_basename($className);

            if (method_exists($this, $method)) {
                return $this->$method($item);
            }

            throw new \Exception(sprintf('Transform method %s not found.', $method));
        });
    }

    public function transformWorker(array $remoteWorker)
    {
        if (filled($remoteWorker)) {
            return WorkerData::fromRequest(requestData: [
                'group_id' => $remoteWorker['gid'],
                'worker_id' => $remoteWorker['worker_id'],
                'name' => $remoteWorker['worker_name'],
                'approximate_hash_rate' => $remoteWorker['shares_1d'],
                'status' => $remoteWorker['status'],
                'unit' => $remoteWorker['shares_unit'],
                'pool_data' => $remoteWorker,
            ]);
        }
    }
}
