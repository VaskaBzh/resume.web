<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class WorkerBuilder extends BaseBuilder
{
    public function withTrashedByWorkerId(int $workerId): Builder
    {
        return $this->where('worker_id', $workerId)->withTrashed();
    }

    public function onlyActive(): Builder
    {
        return $this->where('status', 'ACTIVE');
    }
}
