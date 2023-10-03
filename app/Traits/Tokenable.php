<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

trait Tokenable
{
    public function verifyPasswordChange(Request $request, $id, $hash): JsonResponse|RedirectResponse
    {
        $user = User::find($id);

        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(['status' => 'token not exists or expired'], Response::HTTP_BAD_REQUEST);
        }

        $redirectTo = auth()->check() ? '/profile/settings' : '/login';

        return redirect('/' . '?action=password&user_id=' . $user->id);
    }

    public function checkIfTokenExpired(string $email): bool
    {
        $token = DB::table('password_resets')
            ->where('email', $email)
            ->first();

        if (!$token) {
            return false;
        }

        $expiresAt = Carbon::parse($token->created_at)->addMinutes(config('auth.passwords.users.expire'));

        if (now()->gte($expiresAt)) {
            return false;
        }

        return true;
    }

    public function deleteToken(User $user): void
    {
        DB::table('password_resets')->where('email', $user->email)->delete();
    }
}
