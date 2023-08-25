<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Actions\User\AttachReferral;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachReferralRequest;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AttachController extends Controller
{
    public function __invoke(User $user, AttachReferralRequest $request)
    {
        $owner = User::where('referral_code->code', $request->get('code'))
            ->first();

        if ($owner->id === $user->id) {
            return new JsonResponse([
                'message' => 'Нельзя добавить собственный аккаунт'
            ], Response::HTTP_BAD_REQUEST);
        }

        $ownerSub = Sub::with('user')
            ->find($owner->referral_code['group_id']);

        AttachReferral::execute($user, $ownerSub);
    }
}
