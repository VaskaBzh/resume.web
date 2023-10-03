<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Traits\Tokenable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    use Tokenable;

    public function sendPasswordChangeEmail(): JsonResponse
    {
        $user = auth()->user();
        $user->sendPasswordChangeNotification();

        return new JsonResponse(['message' => 'success']);
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(
                ['message' => __('auth.email.verify.link.expired')],
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($user->update(['password' => Hash::make($request->password)])) {

            $this->deleteToken($user);

            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse(['message' => 'Something went wrong'], Response::HTTP_BAD_REQUEST);
    }
}
