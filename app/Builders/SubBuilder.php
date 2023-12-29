<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Sub;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class SubBuilder extends BaseBuilder
{
    public function getIncomes(?bool $hasTxId): Builder
    {
        return $this->whereHas('incomes', fn (Builder $query) => $hasTxId
            ? $query->whereNotNull('txid')
            : $query
        );
    }

    public function hasWorkerHashRate(): Builder
    {
        return $this->whereHas('workers', fn (Builder $query) => $query
            ->where('hash_per_day', '>', 0)
        );
    }

    public function readyToPayout(): Builder
    {
        $walletVerificationTime = now()->subHours(config('app.wallet_verification_time'));

        return $this->whereHas('wallets', static fn (Builder $query) => $query
            ->where('wallet_updated_at', '<=', $walletVerificationTime)
            ->orWhere(static fn (Builder $subQuery) => $subQuery
                ->whereNull('wallet_updated_at')
                ->where('created_at', '<=', $walletVerificationTime))
        )->where('pending_amount', '>=', config('api.wallet.min_withdrawal'));
    }

    public function getActive(Collection $userIds): Builder
    {
        return Sub::whereIn('user_id', $userIds)->hasWorkerHashRate();
    }

    public function whereExpiredCustomPercent(): Builder
    {
        return $this->whereNotNull('custom_percent_expired_at')
            ->where('custom_percent_expired_at', '<=', now());
    }

    public function lastMonthIncomes(): HasMany
    {
        return $this->model
            ->incomes()
            ->where('created_at', '>=', now()->subMonth());
    }

    public function whereNameIn(Collection $names): Builder
    {
        return $this->whereIn('sub', $names);
    }
}
