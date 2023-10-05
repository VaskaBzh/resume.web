<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Mail\User\PasswordChangeConfirmationMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PasswordChangeController
{
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->only('old_password', 'password', 'password_confirmation'),[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $validator->validate();

        if (!Hash::check($request->old_password, $user->password)) {
            return new JsonResponse([
                'error' => [__('auth.failed')]
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($user->update(['password' => Hash::make($request->password)])) {

            Mail::to($user->email)->send(new PasswordChangeConfirmationMail);

            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse(['message' => 'Something wend wrong'], Response::HTTP_BAD_REQUEST);
    }
}
