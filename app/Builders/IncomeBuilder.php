<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

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

    public function referral(User $user): Builder
    {
        return $this
            ->where('referral_id', $user->id)
            ->where('type', Type::REFERRAL->value);
    }
}
