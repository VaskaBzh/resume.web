<?php

declare(strict_types=1);

namespace App\Dto\Income;

final readonly class IncomeCompleteData
{
    public function __construct(
        public string $status,
        public string $message
    ) {
    }

    public static function fromRequest(array $requestData): IncomeCompleteData
    {
        return new self(
            status: $requestData['status'],
            message: $requestData['message'],
        );
    }
}
