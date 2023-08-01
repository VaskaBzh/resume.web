<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subs;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubResourceCollection;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(User $user, BtcComService $btcComService)
    {
        $subCollection = $btcComService->transformSubCollection(subs: $user->subs()->get());

        return ['data' => $subCollection];
    }
}
