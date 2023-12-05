<?php

declare(strict_types=1);

namespace App\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HashBuilder extends BaseBuilder
{
    public function oldestThan(Carbon $date): Builder
    {
        return $this->where('created_at', '<', $date);
    }

    public function getByOffset(int $groupId, ?int $count = 24): Builder
    {
        return $this->getByGroupId($groupId)
            ->latest()
            ->take($count);
    }
}
