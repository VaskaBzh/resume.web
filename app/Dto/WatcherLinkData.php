<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\Sub;
use App\Models\User;

final readonly class WatcherLinkData
{
    public function __construct(
        public string $name,
        public Sub $sub,
        public User $user,
        public array $allowedRoutes,
    ) {
    }

    public static function fromRequest(array $requestData): WatcherLinkData
    {
        return new self(
            name: $requestData['name'],
            sub: $requestData['sub'],
            user: $requestData['user'],
            allowedRoutes: $requestData['allowedRoutes']
        );
    }
}
