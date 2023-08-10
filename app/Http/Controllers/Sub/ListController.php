<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sub;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkerHashRate\Resources\SubResource;
use App\Services\External\BtcComService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(BtcComService $btcComService): ResourceCollection
    {
        $subCollection = $btcComService->transformSubCollection(subs: auth()->user()->subs()->get());

        return SubResource::collection($subCollection);
    }
}
