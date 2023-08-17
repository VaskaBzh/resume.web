<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;

class SubBuilder extends BaseBuilder
{
    public function getIncomes(?bool $hasTxId): Builder
    {
        return $this->whereHas('incomes', fn(Builder $query) => $hasTxId
            ? $query->whereNotNull('txid')
            : $query
        );
    }

    public function hasWorker(): Builder
    {
       return $this->whereHas('workers');
    }

    public function readyToPayout(): Builder
    {
        return $this
            ->with('wallets')
            ->has('wallets')
            ->where('pending_amount', '>=', Wallet::MIN_BITCOIN_WITHDRAWAL);
    }
}
