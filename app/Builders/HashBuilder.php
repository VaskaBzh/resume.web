<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class HashBuilder extends BaseBuilder
{
    public function oldestThan(int $groupId, string $date): Builder
    {
        return $this
            ->getByGroupId($groupId)
            ->whereDate('created_at', '<=', $date);
    }
}
