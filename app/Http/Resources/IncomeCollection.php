<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Income;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

/**
 * @see Income
 */
#[
    OA\Schema(
        schema: 'IncomeCollection',
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
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
            ),
        ],
        type: 'object'
    )
]

class IncomeCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(static fn (Income $income) => [
                'type' => $income->type,
                'amount' => $income->daily_amount,
                'payout' => $income->payout,
                'hash' => $income->hash,
                'unit' => $income->unit,
                'status' => __('statuses.'.$income->message),
                'income_at' => $income->created_at->toDateTimeString(),
                'payout_at' => $income->payout_at,
                'tx_id' => $income->txid,
                'wallet' => $income->wallet,
            ]),
        ];
    }
}
