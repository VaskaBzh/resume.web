<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'hash' => $this->hash,
            'unit' => $this->unit,
            'amount' => $this->amount,
        ];
    }
}