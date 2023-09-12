<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Dto\WatcherLinkData;

class WatcherLinkService
{
    public static function generateLink(WatcherLinkData $watcherLinkData)
    {
        $token = self::createToken($watcherLinkData->allowedViews);

        dd($token, self::getAllowedViewsFromToken($token));
    }

    public static function createToken(array $allowedViews): string
    {
        return base64_encode(json_encode($allowedViews));
    }

    public static function getAllowedViewsFromToken(string $token)
    {
        return json_decode(base64_decode($token), true);
    }
}
