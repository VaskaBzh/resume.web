<?php

declare(strict_types=1);

namespace App\Dto\Income;

final readonly class CompleteData
{
    public function __construct(
        public string $status,
        public string $message
    ) {
    }

    public static function fromRequest(array $requestData): CompleteData
    {
        return new self(
            status: $requestData['status'],
            message: $requestData['message'],
        );
    }
}
