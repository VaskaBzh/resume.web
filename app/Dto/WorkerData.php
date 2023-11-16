<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class WorkerData
{
    public function __construct(
        public int $group_id,
        public int $worker_id,
        public string $name,
        public int $hashPerDay,
        public string $status,
        public string $unit,
        public array $poolData,
    ) {
    }

    public static function fromArray(array $data): WorkerData
    {
        return new self(
            group_id: (int) $data['group_id'],
            worker_id: (int) $data['worker_id'],
            name: $data['name'],
            hashPerDay: (int) $data['hash_per_day'],
            status: $data['status'],
            unit: $data['unit'],
            poolData: $data['pool_data'],
        );
    }
}
