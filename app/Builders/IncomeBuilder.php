<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\Income\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

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

    public function between(string $column, ?string $from, ?string $to): Builder
    {
        return $this
            ->when($from, fn($query, $from) => $query->where($column, '>=', $from))
            ->when(
                value: Carbon::createFromFormat(
                    format: 'Y-m-d',
                    time: $to ?? now()->format('Y-m-d')
                )->endOfDay(),
                callback: fn($query, $to) => $query->where($column, '<=', $to)
            );
    }
}
