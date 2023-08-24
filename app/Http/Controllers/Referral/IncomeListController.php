<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IncomeListController extends Controller
{
    public function __invoke(User $user)
    {
        if (!$user->referral_code) {
            return new JsonResponse([
                'messate' => 'Referral not exists'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ReferralService::getReferralIncomeCollection($user->referral_code['group_id']);
    }
}
