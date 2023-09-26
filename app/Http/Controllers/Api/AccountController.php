<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AccountController extends ResetPasswordController
{
    public function __invoke(UserUpdateRequest $request): JsonResponse
    {
        $user = auth()->user();

        if ($request->has('password')) {
            $this->changePassword($request);
        }

        $user->update($request->all());

        return new JsonResponse(['message' => 'Аккаунт успешно обновлен']);
    }
}
