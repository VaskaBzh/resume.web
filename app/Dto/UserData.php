<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly final class UserData
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $password,
        public ?string $referralCode
    )
    {
    }

    public static function fromRequest(array $requestData): UserData
    {
        return new self(
            name: $requestData['name'],
            email: Arr::get($requestData, 'email'),
            password: Arr::get($requestData, 'password'),
            referralCode: Arr::get($requestData, 'referral_code')
        );
    }
}
