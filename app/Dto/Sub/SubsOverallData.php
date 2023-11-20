<?php

declare(strict_types=1);

namespace App\Dto\Sub;

use App\Utils\HashRateConverter;
use Illuminate\Support\Collection;

final readonly class SubsOverallData
{
    private function __construct(
        public float $totalHashPerDay,
        public string $perDayUnit,
        public float $totalHashPerMin,
        public string $perMinUnit,
        public int $totalActiveWorkers,
        public int $totalInactiveWorkers,
        public int $totalDeadWorkers,
    ) {
    }

    public static function fromCollection(Collection $subs, Collection $workers): SubsOverallData
    {
        $totalHashPerDay = HashRateConverter::fromPure($subs->sum('hashPerDayPure'));
        $totalHashPerMin = HashRateConverter::fromPure($subs->sum('hashPerMinPure'));
        $workers = $workers->flatMap;

        return new self(
            totalHashPerDay: (float) $totalHashPerDay->value,
            perDayUnit: $totalHashPerDay->unit,
            totalHashPerMin: (float) $totalHashPerMin->value,
            perMinUnit: $totalHashPerMin->unit,
            totalActiveWorkers: $workers->where('status', 'ACTIVE')->count(),
            totalInactiveWorkers: $workers->where('status', 'INACTIVE')->count(),
            totalDeadWorkers: $workers->where('status', 'DEAD')->count(),
        );
    }
}
