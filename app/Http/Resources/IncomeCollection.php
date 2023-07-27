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
                'txid' => $income->txid,
                'wallet' => $income->wallet,
                'payment' => $income->payment,
                'amount' => $income->amount,
                'unit' => $income->unit,
                'status' => $income->statis,
                'message' => $income->message,
                'hash' => $income->hash,
                'created_at' => $income->created_at,
                'updated_at' => $income->updated_at
            ]),
        ];
    }
}
