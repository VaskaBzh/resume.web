<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Income;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/** @mixin Income */
#[
    OA\Schema(
        schema: 'IncomeResource',
        properties: [
            new OA\Property(property: 'type', type: 'string'),
            new OA\Property(property: 'amount', type: 'number'),
            new OA\Property(property: 'hash', type: 'integer'),
            new OA\Property(property: 'unit', type: 'string'),
            new OA\Property(property: 'status', type: 'string'),
            new OA\Property(property: 'message', type: 'string'),
            new OA\Property(property: 'income_at', type: 'date'),
            new OA\Property(property: 'payout_at', type: 'date'),
        ],
        type: 'object'
    )
]
class IncomeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->type,
            'amount' => $this->daily_amount,
            'payout' => $this->payout,
            'hash' => $this->hash,
            'unit' => $this->unit,
            'status' => __('statuses.'.$this->message),
            'income_at' => $this->created_at->toDateTimeString(),
            'payout_at' => $this->payout_at,
            'tx_id' => $this->txid,
            'wallet' => $this->wallet,
        ];
    }
}
