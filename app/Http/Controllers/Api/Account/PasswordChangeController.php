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
    /**
     * @OA\Put(
     *     path="/password/change/{user}",
     *     summary="Change user's password",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"old_password", "password", "password_confirmation"},
     *             @OA\Property(property="old_password", type="string", description="User's old password"),
     *             @OA\Property(property="password", type="string", description="User's new password"),
     *             @OA\Property(property="password_confirmation", type="string", description="Confirmation of the new password")
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
     *             @OA\Property(property="error", type="array", @OA\Items(type="string", description="Error message(s)"))
     *         )
     *     )
     * )
     */
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
