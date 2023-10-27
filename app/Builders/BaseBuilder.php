<?php

declare(strict_types=1);

namespace App\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class BaseBuilder extends Builder
{
    public function getByGroupId(int $groupId): Builder
    {
        return $this->where('group_id', $groupId);
    }

    public function between(string $column, ?string $from, ?string $to): Builder
    {
        return $this
            ->when($from, static fn($query, $from) => $query->where($column, '>=', $from))
            ->when($to, static fn($query, $to) => $query->where(
                $column,
                '<=',
                Carbon::createFromFormat('Y-m-d', $to)->endOfDay()
            ));
    }
}
