<?php

declare(strict_types=1);

namespace App\Dto\WatcherLink;

use App\Models\WatcherLink;
use Illuminate\Support\Arr;

final readonly class UpdateData
{
    public function __construct(
        public WatcherLink $watcherLink,
        public array $allowedRoutes,
        public ?string $name,
    ) {
    }

    public static function fromRequest(array $requestData): UpdateData
    {
        return new self(
            watcherLink: $requestData['watcher_link'],
            allowedRoutes: $requestData['allowed_routes'],
            name: Arr::get($requestData, 'name')
        );
    }
}
