<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Income;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Income */
class IncomeCollection extends ResourceCollection
{
    public function __construct($resource, private ?bool $filter)
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(fn(Income $income) => $this->filter
                ? [
                    'payment' => $income->payment,
                    'txid' => $income->txid,
                    'wallet' => $income->wallet,
                    'updated_at' => $income->updated_at
                ] :
                [
                    'wallet' => $income->wallet,
                    'amount' => $income->amount,
                    'hash' => $income->hash,
                    'unit' => $income->unit,
                    'status' => $income->status,
                    'message' => $income->message,
                    'created_at' => $income->created_at,
                    'updated_at' => $income->updated_at,
                ]
            ),
        ];
    }
}
