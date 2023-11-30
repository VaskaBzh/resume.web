<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class WorkerHashRateData
{
    public function __construct(
        public int $workerId,
        public float $hash,
        public string $unit,
    ) {
    }

    public static function fromRequest(array $requestData): WorkerHashrateData
    {
        return new self(
            workerId: (int) $requestData['worker_id'],
            hash: (float) $requestData['hash'],
            unit: $requestData['unit'],
        );
    }
}
