<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="HashRateResource",
 *     type="object",
 *     @OA\Property(property="hash", type="integer"),
 *     @OA\Property(property="unit", type="string"),
 *     @OA\Property(property="worker_count", type="integer"),
 * )
 */
class HashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'hash' => $this->hash,
            'unit' => $this->unit,
            'worker_count' => $this->worker_count,
        ];
    }
}
