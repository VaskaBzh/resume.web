<?php

declare(strict_types=1);

namespace App\Dto\Sub;

final readonly class SubViewData
{
    public function __construct(
        public string $sub,
        public int $userId,
        public int $groupId,
        public int $activeWorkersCount,
        public int $inactiveWorkersCount,
        public int $deadWorkersCount,
        public int $hashPerMinPure,
        public float $hashPerMin,
        public string $hashPerMinUnit,
        public int $hashPerDayPure,
        public float $hashPerDay,
        public string $hashPerDayUnit,
        public float $pendingAmount,
        public float $totalPayout,
        public float $totalAmount,
        public ?float $yesterdayAmount,
        public ?float $todayForecast,
        public ?float $lastMonthAmount,
    ) {
    }

    public static function fromArray(array $data): SubViewData
    {
        return new self(
            sub: $data['sub'],
            userId: $data['user_id'],
            groupId: $data['group_id'],
            activeWorkersCount: $data['active_workers_count'],
            inactiveWorkersCount: $data['inactive_workers_count'],
            deadWorkersCount: $data['dead_workers_count'],
            hashPerMinPure: $data['hash_per_min_pure'],
            hashPerMin: $data['hash_per_min'],
            hashPerMinUnit: $data['hash_per_min_unit'],
            hashPerDayPure: $data['hash_per_day_pure'],
            hashPerDay: $data['hash_per_day'],
            hashPerDayUnit: $data['hash_per_day_unit'],
            pendingAmount: $data['pending_amount'],
            totalPayout: $data['total_payout'],
            totalAmount: $data['total_amount'],
            yesterdayAmount: $data['yesterday_amount'],
            todayForecast: $data['today_forecast'],
            lastMonthAmount: $data['last_month_amount'],
        );
    }
}
