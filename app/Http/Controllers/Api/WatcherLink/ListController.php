<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WatcherLink;

use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherLinkResource;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Get(
 *     path="/watchers/{user}/{sub}",
 *     summary="Get watcher links for a user's sub",
 *     tags={"Watcher Links"},
 *     @OA\Parameter(
 *         name="user",
 *         in="path",
 *         description="User's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="sub",
 *         in="path",
 *         description="Sub's ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/WatcherLinkResource")
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=403, description="Forbidden"),
 *     @OA\Response(response=404, description="User or sub not found"),
 * )
 */
class ListController extends Controller
{
    public function __invoke(User $user, Sub $sub): ResourceCollection
    {
        return WatcherLinkResource::collection($sub->watcherLinks);
    }
}
