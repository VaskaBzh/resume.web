<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class IncomeBuilder extends BaseBuilder
{
    public function getNotCompleted(int $groupId): Builder
    {
        return $this
            ->where('group_id', $groupId)
            ->groupBy('id', 'status')
            ->having('status', Status::PENDING->value)
            ->orHaving('status', Status::READY_TO_PAYOUT->value)
            ->orHaving('status', Status::REJECTED->value);
    }

    public function getYesterdayIncome(int $groupId): Builder
    {
        return $this
            ->getByGroupId($groupId)
            ->whereDate('created_at', Carbon::yesterday());
    }

    public function getReferralIncomes(Collection $groupIds): Builder
    {
        return $this
            ->whereIn('group_id', $groupIds)
            ->where('type', 'referral');
    }
}
