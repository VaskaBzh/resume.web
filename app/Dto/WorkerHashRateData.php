<?php

declare(strict_types=1);

namespace App\Dto;

readonly final class WorkerHashRateData
{
    public function __construct(
        public int $workerId,
        public int $hash,
        public string $unit,
    ) {
    }

    public static function fromRequest(array $requestData): WorkerHashrateData
    {
        return new self(
            workerId: $requestData['worker_id'],
            hash: $requestData['hash'],
            unit: $requestData['unit'],
        );
    }
}
