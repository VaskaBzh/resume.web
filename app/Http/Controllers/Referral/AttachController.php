<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachReferralRequest;
use App\Models\User;
use App\Services\Internal\ReferralService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AttachController extends Controller
{
    public function __invoke(User $user, AttachReferralRequest $request): JsonResponse
    {
        try {
            ReferralService::attach(user: $user, code: $request->code);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Реферальная программа успешно принята'
        ], Response::HTTP_OK);
    }
}
