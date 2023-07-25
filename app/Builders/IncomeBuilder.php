<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use Illuminate\Database\Eloquent\Builder;

class IncomeBuilder extends BaseBuilder
{
    public function getNotCompleted(int $groupId, string $walletUid): Builder
    {
        return $this
            ->where('group_id', $groupId)
            ->where('wallet', $walletUid)
            ->groupBy('id', 'status')
            ->having('status', Status::PENDING->value)
            ->orHaving('status', Status::REJECTED->value);
    }
}
