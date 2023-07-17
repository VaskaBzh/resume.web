<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;

class WalletBuilder extends Builder
{
    private const MAX_PERCENT = 100;

    public function isExceeded(int $groupId, int $percent): bool
    {
        $percentSum = Wallet::where('group_id', $groupId)
            ->sum('percent');

        if ($percentSum + $percent > self::MAX_PERCENT) {
            return true;
        }

        return false;
    }

    public function isLast(int $groupId): bool
    {
        return Wallet::where('group_id', $groupId)->count() === 1;
    }

    public function getByAddress(string $address): Builder
    {
        return Wallet::where('wallet', $address);
    }
}
