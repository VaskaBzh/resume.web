<?php

declare(strict_types=1);

namespace App\Dto\WatcherLink;

use App\Models\Sub;
use App\Models\User;

final readonly class CreateData
{
    public function __construct(
        public string $name,
        public Sub $sub,
        public User $user,
        public array $allowedRoutes,
    ) {
    }

    public static function fromRequest(array $requestData): CreateData
    {
        return new self(
            name: $requestData['name'],
            sub: $requestData['sub'],
            user: $requestData['user'],
            allowedRoutes: $requestData['allowedRoutes']
        );
    }
}