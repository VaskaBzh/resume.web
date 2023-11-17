<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

trait Tokenable
{
    #[
        OA\Get(
            path: '/password/reset/verify/{id}/{hash}',
            summary: 'Verify password reset token',
            tags: ['Auth'],
            parameters: [
                new OA\Parameter(
                    name: 'id',
                    description: "User's ID",
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(
                        type: 'string'
                    )
                ),
                new OA\Parameter(
                    name: 'hash',
                    description: 'Reset token hash',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(
                        type: 'string'
                    )
                ),
            ],
            responses: [
                new OA\Response(
                    response: Response::HTTP_MOVED_PERMANENTLY,
                    description: 'Token is valid, redirect to password reset page',
                    headers: [
                        new OA\Header(
                            header: 'Location',
                            description: 'Password reset URL',
                            schema: new OA\Schema(
                                type: 'string'
                            )
                        ),
                    ]
                ),
                new OA\Response(
                    response: Response::HTTP_UNPROCESSABLE_ENTITY,
                    description: 'Bad request, token not exists or expired',
                    content: [
                        new OA\JsonContent(
                            type: 'object',
                            example: [
                                'errors' => [
                                    'property' => ['message'],
                                ],
                            ]
                        ),
                    ],
                ),
            ]
        )
    ]
    public function verifyPasswordReset(Request $request, $id, $hash): JsonResponse|RedirectResponse
    {
        $user = User::find($id);

        if (! $this->checkIfTokenExpired($user->email)) {
            return new JsonResponse([
                'errors' => [
                    'auth' => ['token not exists or expired'],
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->deleteToken($user);

        return redirect('/'.'?action=password&user_id='.$user->id.'&hash='.$hash);
    }

    public function checkIfTokenExpired(string $email): bool
    {
        $token = DB::table('password_resets')
            ->where('email', $email)
            ->first();

        if (! $token) {
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
        DB::table('password_resets')
            ->where('email', $user->email)
            ->delete();
    }
}
