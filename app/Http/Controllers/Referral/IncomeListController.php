<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeListController extends Controller
{
    public function __invoke(
        User $user,
        Request $request,
        UserRepository $userRepository
    )
    {
        if (!$user->referral_code) {
            return new JsonResponse([
                'messate' => 'Referral not exists'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $userRepository
            ->getReferralIncomeCollection($user->referral_code['group_id'])
            ->paginate($request->per_page ?? 15);
    }
}
