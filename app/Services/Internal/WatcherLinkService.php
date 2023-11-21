<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\WatcherLink\Create;
use App\Dto\WatcherLinkData;
use App\Models\WatcherLink;

readonly class WatcherLinkService
{
    private function __construct(
        private WatcherLinkData $watcherLinkData,
    ) {
    }

    public static function withParams(WatcherLinkData $watcherLinkData): WatcherLinkService
    {
        return new self(watcherLinkData: $watcherLinkData);
    }

    private function createToken(): string
    {
        return base64_encode(json_encode([
            'name' => $this->watcherLinkData->name,
            'group_id' => $this->watcherLinkData->sub->group_id,
        ]));
    }

    public static function isRouteAllowed(string $routeName, string $token): bool
    {
        $allowedRoutes = WatcherLinkService::getAllowedRoutes(token: $token) ?? [];

        return in_array($routeName, $allowedRoutes);
    }

    public static function getAllowedRoutes(string $token): ?array
    {
        return WatcherLink::where('token', $token)
            ->first()
            ?->allowed_routes;
    }

    public function createLink(): WatcherLink
    {
        $token = $this->createToken();

        return Create::execute(
            watcherLinkData: $this->watcherLinkData,
            token: $token,
        );
    }
}
