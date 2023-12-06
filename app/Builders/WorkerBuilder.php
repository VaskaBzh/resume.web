<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Worker\Status;
use Illuminate\Database\Eloquent\Builder;

class WorkerBuilder extends BaseBuilder
{
    public function byStatus(?string $status): Builder
    {
        return $this->when($status, function (Builder $query) use ($status) {
            $query->where('status', $status);
        }, function (Builder $query) {
            $query->whereNot('status', Status::DEAD->value);
        });
    }
}
