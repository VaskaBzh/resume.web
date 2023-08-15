<?php

declare(strict_types=1);

namespace App\Http\Controllers\WorkerHashRate\Resources;

use App\Models\Payout;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Payout */
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
