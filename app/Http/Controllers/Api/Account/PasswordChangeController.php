<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        if ($user->update(['password' => Hash::make($request->password)])) {
            return new JsonResponse(['message' => 'success']);
        }

        return new JsonResponse(['message' => 'Something wend wrong'], Response::HTTP_BAD_REQUEST);
    }
}
