<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class HashBuilder extends BaseBuilder
{
    public function getByOffset(int $groupId, ?int $count = 24): Builder
    {
        return $this->getByGroupId($groupId)
            ->latest()
            ->take($count);
    }
}
