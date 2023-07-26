<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class WorkerBuilder extends BaseBuilder
{
    public function oldestHashRatesThan(string $date): Builder
    {
        return $this->workerHashrates()->whereDate('created_at', '<=', $date);
    }
}
