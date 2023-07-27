<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class WorkerHashRateBuilder extends BaseBuilder
{
    public function oldestThan(int $workerId, string $date): Builder
    {
        return $this
            ->where('worker_id', $workerId)
            ->whereDate('created_at', '<=', $date);
    }
}
