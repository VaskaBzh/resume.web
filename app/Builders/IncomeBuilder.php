<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class IncomeBuilder extends Builder
{
    /**
     * Фильтрация по группе
     */
    public function getByGroupId(int $groupId): Builder
    {
        return $this->where('group_id', $groupId);
    }
}
