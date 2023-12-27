<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class WorkerHashRateBuilder extends BaseBuilder
{
    public function dailyHashRates(int $workerId): Builder
    {
        return $this->where('worker_id', $workerId)
            ->where('created_at', '>=', now()->subDay());
    }

    public function getByOffset(int $workerId, ?int $count = 24): Builder
    {
        return $this->where('worker_id', $workerId)
            ->latest()
            ->take($count);
    }
}
