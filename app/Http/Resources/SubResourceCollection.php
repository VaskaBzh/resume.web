<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Sub */
class SubResourceCollection extends ResourceCollection
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(fn(array $sub) => $sub)
        ];
    }
}
