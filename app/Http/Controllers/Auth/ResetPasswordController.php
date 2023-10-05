<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Mail\User\PasswordChangeConfirmationMail;
use App\Models\User;
use App\Traits\Tokenable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    use Tokenable;

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        if (!hash_equals(hash('sha256', $user->getEmailForVerification()), $request->hash)) {

            return new JsonResponse(
                ['message' => __('auth.email.verify.link.expired')],
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($user->update(['password' => Hash::make($request->password)])) {

            Mail::to($user->email)->send(new PasswordChangeConfirmationMail);

            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse(['message' => 'Something went wrong'], Response::HTTP_BAD_REQUEST);
    }
}
