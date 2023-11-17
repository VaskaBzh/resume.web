<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class WorkerData
{
    public function __construct(
        public int $groupId,
        public int $workerId,
        public string $name,
        public string $status,
        public int $hashPerDay,
        public string $unitPerDay,
        public int $hashPerMin,
        public string $unitPerMin,
        public array $poolData,
    ) {
    }

    public static function fromArray(array $data): WorkerData
    {
        return new self(
            groupId: (int) $data['group_id'],
            workerId: (int) $data['worker_id'],
            name: $data['name'],
            status: $data['status'],
            hashPerDay: (int) $data['hash_per_day'],
            unitPerDay: $data['unit_per_day'],
            hashPerMin: (int) $data['hash_per_min'],
            unitPerMin: $data['unit_per_min'],
            poolData: $data['pool_data']
        );
    }
}
