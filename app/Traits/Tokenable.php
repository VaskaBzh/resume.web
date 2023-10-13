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
    /**
     * @OA\Get(
     *     path="/password/reset/verify/{id}/{hash}",
     *     summary="Verify password reset token",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User's ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="hash",
     *         in="path",
     *         description="Reset token hash",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request, token not exists or expired",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", description="Error message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Token is valid, redirect to password reset page",
     *         @OA\Header(header="Location", @OA\Schema(type="string"), description="Password reset URL")
     *     )
     * )
     */
    public function verifyPasswordReset(Request $request, $id, $hash): JsonResponse|RedirectResponse
    {
        $user = User::find($id);

        if (!$this->checkIfTokenExpired($user->email)) {
            return new JsonResponse(['status' => 'token not exists or expired'], Response::HTTP_BAD_REQUEST);
        }

        $this->deleteToken($user);

        return redirect('/' . '?action=password&user_id=' . $user->id . '&hash=' . $hash);
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
