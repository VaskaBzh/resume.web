<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function byStatus(?string $status): HasMany|Builder
    {
        return $status ? $this->model->where('status', $status) : $this->model;
    }
}
