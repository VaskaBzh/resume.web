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

    /**
     * @OA\Put(
     *     path="/password/restore/{user}",
     *     summary="Restore user password",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"hash", "password"},
     *             @OA\Property(property="hash", type="string", description="Hash value for email verification"),
     *             @OA\Property(property="password", type="string", description="User's new password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Success message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Error message")
     *         )
     *     )
     * )
     */
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
