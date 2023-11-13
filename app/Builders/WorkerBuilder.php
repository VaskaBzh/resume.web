<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class WorkerBuilder extends BaseBuilder
{
    public function byStatus(?string $status): Builder
    {
        return $this->when($status, function (Builder $query) use ($status) {
            $query->where('status', $status);
        });
    }
}
