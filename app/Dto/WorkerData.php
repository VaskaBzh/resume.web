<?php

declare(strict_types=1);

namespace App\Dto;

readonly class WorkerData
{
    public function __construct(
        public int $group_id,
        public int $worker_id
    )
    {
    }

    public static function fromRequest(array $requestData): WorkerData
    {
        return new self(
            group_id: $requestData['group_id'],
            worker_id: $requestData['worker_id']
        );
    }
}
