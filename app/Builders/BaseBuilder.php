<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class BaseBuilder extends Builder
{
    /**
     * Фильтрация по группе
     */
    public function getByGroupId(int $groupId): Builder
    {
        return $this->where('group_id', $groupId);
    }

    /**
     * Фильтрация по дате
     *
     */
    public function oldestThan(int $groupId, string $date): Builder
    {
        return $this
            ->getByGroupId($groupId)
            ->whereDate('created_at', '<=', $date);
    }

}
