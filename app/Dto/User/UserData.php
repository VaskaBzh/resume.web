<?php

namespace App\Dto\User;

readonly class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }

    public static function fromRequest(array $requestData): UserData
    {
        return new self(
            name: $requestData['name'],
            email: $requestData['email'],
            password: $requestData['password'],
        );
    }
}
