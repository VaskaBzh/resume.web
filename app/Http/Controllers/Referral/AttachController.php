<?php

declare(strict_types=1);

namespace App\Http\Controllers\Referral;

use App\Actions\User\AttachReferral;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachReferralRequest;
use App\Models\Sub;
use App\Models\User;

class AttachController extends Controller
{
    public function __invoke(User $user, AttachReferralRequest $request)
    {
        $groupId = User::where('referral_code->code', $request->get('code'))
            ->first()
            ->referral_code['group_id'];

        $owner = Sub::find($groupId);

        AttachReferral::execute($user, $owner);
    }
}
