<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuilder extends BaseBuilder
{
    public function activeSub(): HasMany
    {
        return $this->model
            ->subs()
            ->where('group_id', $this->model->active_sub);
    }

    public function withSubsWorkerStats(): Builder
    {
        return $this->with(['subs' => function ($query) {
            $query->withSum('workers', 'hash_per_day');
            $query->withCount(['workers as total_active_workers' => fn ($query) => $query->active()]);
            $query->withCount(['workers as total_inactive_workers' => fn ($query) => $query->inactive()]);
        }]);
    }

    public function totalReferralIncomes(): Builder
    {
        return $this->withSum('referralIncomes as total_income', 'daily_amount');
    }
}
