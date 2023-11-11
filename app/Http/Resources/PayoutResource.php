<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Payout;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @see Payout
 */
#[
    OA\Schema(
        schema: 'PayoutResource',
        properties: [
            new OA\Property(property: 'wallet', type: 'string'),
            new OA\Property(property: 'payout', type: 'float'),
            new OA\Property(property: 'txid', type: 'string'),
            new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        ],
        type: 'object'
    )
]
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
