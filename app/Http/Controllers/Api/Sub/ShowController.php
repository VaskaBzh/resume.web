<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResource;
use App\Models\Sub;
use App\Services\External\BtcComService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowController extends Controller
{
    public function __invoke(
        Request       $request,
        Sub           $sub,
        BtcComService $btcComService,
    ): JsonResource
    {
        if (!$request->attributes->get('access_key_valid')) {

            $this->authorize('viewOrChange', $sub);
        }

        return new SubResource($btcComService->transformSub($sub));
    }
}
