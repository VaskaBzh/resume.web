<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subs;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResource;
use App\Models\Sub;
use App\Services\External\BtcComService;

class ShowController extends Controller
{
    public function __invoke(Sub $sub, BtcComService $btcComService)
    {
        return new SubResource($btcComService->transformSub($sub));
    }
}
