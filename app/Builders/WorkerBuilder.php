<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Worker\Status;
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

    public function onlyInactive(): Builder
    {
        return $this->where('status', 'INACTIVE');
    }

    public function onlyDead(): Builder
    {
        return $this->where('status', 'DEAD');
    }

    public function byStatus(?string $status): Builder
    {
        return $this->when($status, function (Builder $query) use ($status) {
            $query->where('status', $status);
        });
    }
}
