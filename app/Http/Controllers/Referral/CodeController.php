<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function __invoke(User $user, Request $request): JsonResponse
    {
        try {
            $code = ReferralService::generateCode(user: $user, groupId: (int) $request->group_id);

            return new JsonResponse([
                'success' => true,
                'message' => 'Реферальный код успешно создан',
                'referral_url' => route('page', 'registration?referral_code=' . $code),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 403);
        }
    }
}
