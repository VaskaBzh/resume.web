<?php

declare(strict_types=1);

namespace App\Http\Controllers\WorkerHashRate\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'values' => $this['values']
        ];
    }
}
