<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Payout;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @see Payout
 *
 *  @OA\Schema(
 *      schema="PayoutResource",
 *      type="object",
 *      @OA\Property(property="wallet", type="string"),
 *      @OA\Property(property="payout", type="float"),
 *      @OA\Property(property="txid", type="string"),
 *      @OA\Property(property="created_at", type="string", format="date-time"),
 *  )
 *
 */
class PayoutResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'wallet' => $this->wallet->wallet,
            'payout' => $this->payout,
            'txid' => $this->txid,
            'created_at' => $this->created_at,
        ];
    }
}
