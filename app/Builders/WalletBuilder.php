<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class WalletBuilder extends BaseBuilder
{
    /**
     * Проверка кошельков на множество
     */
    public function isOne(int $groupId): bool
    {
        return $this->where('group_id', $groupId)->count() === 1;
    }

    /**
     * Фильтрация по адресу кошелька
     */
    public function getByAddress(string $address): Builder
    {
        return $this->where('wallet', $address);
    }
}
