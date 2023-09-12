<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\WatcherLink\Create;
use App\Dto\WatcherLinkData;
use App\Models\WatcherLink;

class WatcherLinkService
{
    private function __construct(
        private WatcherLinkData $watcherLinkData,
    )
    {
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

    public static function isAllowedRoute(string $token, $route)
    {
        $watcherLink = WatcherLink::where('token', $token)->first();

        dd($watcherLink);
    }

    public function createLink(): void
    {
        $token = $this->createToken();

        Create::execute(
            watcherLinkData: $this->watcherLinkData,
            token: $token,
        );
    }
}
