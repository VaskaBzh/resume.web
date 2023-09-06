<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeListController extends Controller
{
    public function __invoke(
        User $user,
        Request $request
    )
    {
        if (!$user->referral_code) {
            return new JsonResponse([
                'messate' => 'Referral not exists'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ReferralService::getReferralIncomes($user->subs()->first()->group_id, 15);
    }
}
