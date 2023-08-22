<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Income;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Income */
class IncomeCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(static fn(Income $income) => [
                    'wallet' => $income->wallet?->wallet,
                    'amount' => $income->daily_amount,
                    'hash' => $income->hash,
                    'status' => $income->status,
                    'message' => $income->message,
                    'created_at' => $income->created_at,
                    'updated_at' => $income->updated_at,
                ]
            ),
        ];
    }
}
