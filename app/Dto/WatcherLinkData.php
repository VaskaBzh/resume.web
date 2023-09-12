<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\Sub;

readonly final class WatcherLinkData
{
    public function __construct(
        public string $name,
        public Sub $sub,
        public array $allowedViews,
    )
    {
    }

    public static function fromRequest(array $requestData): WatcherLinkData
    {
        return new self(
            name: $requestData['name'],
            sub: $requestData['sub'],
            allowedViews: $requestData['allowedViews']
        );
    }
}
