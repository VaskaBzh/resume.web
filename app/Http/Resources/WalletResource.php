<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Wallet */
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
            'payment' => $this->payment,
        ];
    }
}
