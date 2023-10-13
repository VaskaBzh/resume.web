<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @OA\Post(
     *     path="/login",
     *     summary="User login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              oneOf={
     *                  @OA\Property(property="email", type="string", format="email", description="User's email"),
     *                  @OA\Property(property="password", type="string", description="User's password"),
     *                  @OA\Property(property="google2fa_code", type="string", description="Google Authenticator code")
     *              },
     *              example={"email": "user@example.com", "password": "password"}
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", ref="#/components/schemas/UserResource"),
     *             @OA\Property(property="token", type="string", description="User access token"),
     *             @OA\Property(property="expired_at", type="string", format="date-time", description="Token expiration date"),
     *             @OA\Property(property="has_referral_role", type="boolean", description="Indicates if the user has the referral role")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="array", @OA\Items(type="string", description="Error message(s)"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="array", @OA\Items(type="string", description="Error message(s)"))
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return new JsonResponse([
                'error' => [__('auth.failed')]
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$request->user->hasVerifiedEmail()) {
            return new JsonResponse([
                'error' => [__('auth.email.not.verified', ['email' => $request->user->email])]
            ], Response::HTTP_FORBIDDEN);
        }

        $request
            ->user
            ->tokens()
            ->delete();
        $token = $request->user->createToken($request->user->name, ['*'], now()->addMinutes(config('sanctum.expiration')));

        return new JsonResponse([
            'user' => new UserResource($request->user),
            'token' => $token->plainTextToken,
            'expired_at' => $token->accessToken->expires_at,
            'has_referral_role' => $request->user->hasRole('referral')
        ]);
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     summary="User logout",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(type="string", description="Logout confirmation message")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", description="Error message")
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        auth()->user()
            ?->tokens()
            ->delete();

        return response()->json('Logged out');
    }

    /**
     * @OA\Put(
     *     path="/decrease/token",
     *     summary="Decrease the expiration time of the current token",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=204,
     *         description="No content (Token expiration time decreased successfully)"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", description="Error message")
     *         )
     *     )
     * )
     */
    public function decreaseTokenTime(): void
    {
        auth()
            ->user()
            ->tokens()
            ->first()
            ->update(['expires_at' => now()->addHours(2)]);
    }
}
