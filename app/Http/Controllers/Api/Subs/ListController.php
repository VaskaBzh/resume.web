<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subs;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCollection;
use App\Models\User;
use App\Services\External\BtcComService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListController extends Controller
{
    public function __invoke(User $user, BtcComService $btcComService): ResourceCollection
    {
        $subCollection = $btcComService->transformSubCollection(subs: $user->subs()->get());

        return new SubCollection($subCollection);
    }
}
