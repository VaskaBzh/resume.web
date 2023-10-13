<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/user/{user}",
     *     summary="Get user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User's ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *      ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="User not found"),
     * )
     */
    public function __invoke(User $user): UserResource
    {
        $this->authorize('viewAny', $user);

        return new UserResource($user);
    }
}
