<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see Sub
 *
 * @OA\Schema(
 *      schema="ReferralResourceCollection",
 *      type="object",
 *      @OA\Property(
 *          property="data",
 *          type="array",
 *          @OA\Items(
 *              type="object",
 *              @OA\Property(property="email", type="string"),
 *              @OA\Property(property="referral_active_workers_count", type="integer"),
 *              @OA\Property(property="referral_inactive_workers_count", type="integer"),
 *              @OA\Property(property="referral_hash_per_day", type="float"),
 *              @OA\Property(property="total_amount", type="float"),
 *          ),
 *      ),
 *  )
 */
class ReferralResourceCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
