<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\User\UpdateConfirmationCode;
use App\Http\Controllers\Controller;
use App\Mail\User\CodeEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SendCodeController extends Controller
{
    public function __invoke(User $user): JsonResponse
    {
        Mail::to($user->email)
            ->send(new CodeEmail(UpdateConfirmationCode::execute($user)));

        return new JsonResponse([
            'message' => __('auth.email.verify', ['value' => $user->email]),
        ]);
    }
}
