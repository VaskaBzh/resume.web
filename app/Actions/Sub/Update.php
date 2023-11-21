<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Dto\Sub\SubUpsertData;
use App\Models\Sub;

class Update
{
    public static function execute(SubUpsertData $subData, Sub $sub): void
    {
        $sub->update(
            [
                'sub' => $subData->subName,
                'pending_amount' => $subData->pendingAmount ?? $sub->pending_amount,
                'total_amount' => $subData->totalAmount ?? $sub->total_amount,
            ]
        );
    }
}
