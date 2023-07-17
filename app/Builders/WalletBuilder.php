<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;

class WalletBuilder extends Builder
{
    private const MAX_PERCENT = 100;

    /**
     * Проверка суммы процентов всех кошельков на превышение допустимого лимита
     */
    public function isExceeded(int $groupId, int $percent): bool
    {
        $percentSum = $this->where('group_id', $groupId)
            ->sum('percent');

        if ($percentSum + $percent > self::MAX_PERCENT) {
            return true;
        }

        return false;
    }

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

    /**
     * Фильтрация по группе
     */
    public function getByGroupId(int $groupId): Builder
    {
        return $this->where('group_id', $groupId);
    }
}
