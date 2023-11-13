<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\User;

final readonly class ReferralData
{
    public function __construct(
        public User $user,
        public string $code,
    ) {
    }

    public static function fromRequest(array $requestData): ReferralData
    {
        return new self(
            user: $requestData['user'],
            code: $requestData['code'],
        );
    }
}
