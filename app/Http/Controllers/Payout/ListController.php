<?php

namespace App\Http\Controllers\Payout;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WorkerHashRate\Resources\PayoutResource;
use App\Models\Payout;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        $payoutsCollection = Payout::getByGroupId($sub->group_id)
            ->paginate($request->per_page ?? 15);

        return PayoutResource::collection($payoutsCollection);
    }
}
