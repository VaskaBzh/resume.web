<?php

declare(strict_types=1);

namespace App\Http\Resources;

use OpenApi\Attributes as OA;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

/** @see Wallet */

#[
    OA\Schema(
        schema: 'WalletResource',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'percent', type: 'float'),
            new OA\Property(property: 'minWithdrawal', type: 'float'),
            new OA\Property(property: 'wallet', type: 'string'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'total_payout', type: 'float'),
            new OA\Property(property: 'is_unlocked', type: 'boolean'),
        ],
        type: 'object'
    )
]
class WalletResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'percent' => $this->percent,
            'minWithdrawal' => $this->minWithdrawal,
            'wallet' => $this->wallet,
            'name' => $this->name,
            'total_payout' => $this->total_payout,
            'is_unlocked' => $this->isUnlocked(),
        ];
    }
}
