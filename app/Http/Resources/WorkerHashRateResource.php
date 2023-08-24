<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\WorkerHashrate;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkerHashrate */
class WorkerHashRateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'unit' => $this->unit,
            'worker_id' => $this->worker_id,
        ];
    }
}
