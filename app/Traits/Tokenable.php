<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

trait Tokenable
{
    public function verifyPasswordChange(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(['status' => 'token not exists or expired'], Response::HTTP_BAD_REQUEST);
        }

        return redirect($request->redirect_to . '?action=password');
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
