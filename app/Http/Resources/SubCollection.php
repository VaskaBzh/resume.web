<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Sub;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Sub */
class SubCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
