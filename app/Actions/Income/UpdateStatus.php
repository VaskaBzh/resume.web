<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\DtoContract;
use App\Models\Income;

class UpdateStatus
{
    public static function execute(DtoContract $updateStatusData): void
    {
        Income::whereNotCompleted($updateStatusData->sub->group_id)->update([
            'status' => $updateStatusData->status->value,
            'payout_id' => $updateStatusData->payout?->id,
        ]);
    }
}
