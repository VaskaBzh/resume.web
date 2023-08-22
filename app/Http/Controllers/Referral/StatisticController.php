<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticController extends Controller
{
    public function __invoke(User $user)
    {
        if (!$user->referral_code) {
            return new JsonResponse(['message' => 'referral code not exists'], 422);
        }

        $sub = Sub::getByGroupId($user->referral_code['group_id'])->first();
        $referrals = $sub->referrals()->get();
        dd($referrals);
//        return new JsonResource();
    }
}
