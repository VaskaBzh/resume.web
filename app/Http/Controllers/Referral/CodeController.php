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
        $result = ReferralService::generateCode(user: $user, groupId: $request->group_id);

        if (!$result) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Ошибка создания кода'
            ], 403);
        }

        return new JsonResponse([
            'success' => true,
            'message' => 'Реферальный код успешно создан'
        ]);
    }
}
