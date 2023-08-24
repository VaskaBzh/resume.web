<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Sub;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResource;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(User $user, BtcComService $btcComService): ResourceCollection
    {
        $subCollection = $btcComService->transformSubCollection(subs: $user->subs()->get());

        return SubResource::collection($subCollection);
    }
}
