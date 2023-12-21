<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class IncomeBuilder extends BaseBuilder
{
    public function whereNotCompleted(int $groupId): Builder
    {
        return $this
            ->getByGroupId($groupId)
            ->whereNot('status', Status::COMPLETED->value);
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
