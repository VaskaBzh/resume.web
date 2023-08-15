<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\Worker;

readonly final class WorkerHashRateData
{
    public function __construct(
        public Worker $worker,
        public int $hash,
        public string $unit,
    ) {
    }

    public static function fromRequest(array $requestData): WorkerHashrateData
    {
        return new self(
            worker: $requestData['worker'],
            hash: $requestData['hash'],
            unit: $requestData['unit'],
        );
    }
}
