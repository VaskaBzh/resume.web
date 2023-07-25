<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use Illuminate\Database\Eloquent\Builder;

class IncomeBuilder extends BaseBuilder
{
    public function getPrevious(int $groupId, ?string $walletUid): Builder
    {
        $incomeQuery = $this->where('group_id', $groupId);
        $incomeHasWalletQuery = $incomeQuery->where('wallet', $walletUid);

        if ($incomeHasWalletQuery) {
            return $incomeHasWalletQuery->latest();
        }

        return $incomeQuery->latest();
    }

    public function getNotCompleted(int $groupId, string $walletUid): Builder
    {
        $query =  $this
            ->where('group_id', $groupId)
            ->where('wallet', $walletUid)
            ->where('status', Status::PENDING->value)
            ->orWhere('status', Status::REJECTED->value);

        dd($query->get());
    }
}
