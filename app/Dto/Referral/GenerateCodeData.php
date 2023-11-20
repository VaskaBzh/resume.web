<?php

declare(strict_types=1);

namespace App\Dto\Referral;

use App\Models\User;

final readonly class GenerateCodeData
{
    public function __construct(
        public User $user,
        public string $code,
    ) {
    }

    public static function fromRequest(array $requestData): GenerateCodeData
    {
        return new self(
            user: $requestData['user'],
            code: $requestData['code'],
        );
    }
}
