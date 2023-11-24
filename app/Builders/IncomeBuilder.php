<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use App\Models\Sub;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class IncomeBuilder extends BaseBuilder
{
    public function getNotCompleted(int $groupId): Builder
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

    public function withPayouts(Sub $sub): Builder
    {
        return $this->leftJoin('payouts', function (JoinClause $join) {
            $join->on('incomes.group_id', '=', 'payouts.group_id')
                ->whereRaw('DATE(incomes.created_at) = DATE(payouts.created_at)');
        })->leftJoin('wallets', 'payouts.wallet_id', 'wallets.id')
            ->where('incomes.group_id', $sub->group_id);
    }
}
