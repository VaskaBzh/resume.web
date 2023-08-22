<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Actions\User\GenerateReferralCode;
use App\Dto\ReferralData;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function __invoke(User $user, Request $request): JsonResponse
    {
        $result = GenerateReferralCode::execute(
            referralData: ReferralData::fromRequest([
                'user' => $user,
                'group_id' => $request->group_id,
                'code' => Helper::generateUniqReferralCode(),
                'sub_profit_percent' => 1,
                'user_discount_percent' => 1,
            ])
        );

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
