<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

readonly class UserData
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $password
    )
    {
    }

    public static function fromRequest(array $requestData): UserData
    {
        return new self(
            name: $requestData['name'],
            email: Arr::get($requestData, 'email'),
            password: Arr::get($requestData, 'password'),
        );
    }
}
