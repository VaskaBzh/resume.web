<?php

declare(strict_types=1);

namespace App\Builders;

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
}
