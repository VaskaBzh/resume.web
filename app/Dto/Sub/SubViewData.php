<?php

namespace App\Dto\Sub;

class SubViewData
{
    public function __construct(
        public $sub,
        public $userId,
        public $groupId,
        public $activeWorkersCount,
        public $inactiveWorkersCount,
        public $unstableWorkersCount,
        public $hashPerMin,
        public $hashPerMinUnit,
        public $hashPerDay,
        public $hashPerDayUnit,
        public $totalPayout,
        public $totalAmount,
        public $yesterdayAmount,
        public $todayForecast,
        public $lastMonthAmount,
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
            unstableWorkersCount: $data['dead_workers_count'],
            hashPerMin: $data['hash_per_min'],
            hashPerMinUnit: $data['hash_per_min_unit'],
            hashPerDay: $data['hash_per_day'],
            hashPerDayUnit: $data['hash_per_day_unit'],
            totalPayout: $data['total_payout'],
            totalAmount: $data['total_amount'],
            yesterdayAmount: $data['yesterday_amount'],
            todayForecast: $data['today_forecast'],
            lastMonthAmount: $data['last_month_amount'],
        );
    }
}
