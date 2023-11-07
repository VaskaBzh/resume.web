<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SubBuilder extends BaseBuilder
{
    public function getIncomes(?bool $hasTxId): Builder
    {
        return $this->whereHas('incomes', fn(Builder $query) => $hasTxId
            ? $query->whereNotNull('txid')
            : $query
        );
    }

    public function hasWorkerHashRate(): Builder
    {
        return $this->whereHas('workers', fn(Builder $query) => $query
            ->where('status', 'ACTIVE')
        );
    }

    public function readyToPayout(): Builder
    {
        return $this
            ->with('wallets')
            ->has('wallets')
            ->where('pending_amount', '>=', Wallet::MIN_BITCOIN_WITHDRAWAL);
    }

    public function getActive(Collection $userIds): Builder
    {
        return Sub::whereIn('user_id', $userIds)->hasWorkerHashRate();
    }

    public function whereExpiredCustomPercent(): Builder
    {
        return $this
            ->whereNotNull('custom_percent_expired_at')
            ->where('custom_percent_expired_at', '<=', now());
    }
}
