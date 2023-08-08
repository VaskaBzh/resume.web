<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly class WorkerData
{
    public function __construct(
        public int $group_id,
        public int $worker_id,
        public ?float $approximateHashRate
    )
    {
    }

    public static function fromRequest(array $requestData): WorkerData
    {
        return new self(
            group_id: (int) $requestData['group_id'],
            worker_id: (int) $requestData['worker_id'],
            approximateHashRate: (float) Arr::get($requestData, 'approximate_hash_rate'),
        );
    }
}
