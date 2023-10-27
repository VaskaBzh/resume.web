<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly final class WorkerData
{
    public function __construct(
        public int $group_id,
        public int $worker_id,
        public string $name,
        public ?float $approximateHashRate,
        public string $status,
        public string $unit,
        public array $poolData,
    )
    {
    }

    public static function fromRequest(array $requestData): WorkerData
    {
        return new self(
            group_id: (int) $requestData['group_id'],
            worker_id: (int) $requestData['worker_id'],
            name: $requestData['name'],
            approximateHashRate: (float) Arr::get($requestData, 'approximate_hash_rate'),
            status: $requestData['status'],
            unit: $requestData['unit'],
            poolData: $requestData['pool_data'],
        );
    }
}
