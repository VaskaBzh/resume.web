<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Sub */
class ReferralResourceCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
