<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PayoutResource;
use App\Models\Payout;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayoutListController extends Controller
{
    public function __invoke(Sub $sub, Request $request): JsonResource
    {
        $payoutsCollection = Payout::getByGroupId($sub->group_id)
            ->paginate($request->per_page ?? 15);

        return PayoutResource::collection($payoutsCollection);
    }
}
