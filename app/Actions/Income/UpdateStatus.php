<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\UpdateStatusData;
use App\Models\Income;

class UpdateStatus
{
    public static function execute(
        UpdateStatusData $updateStatusData
    ): void {
        Income::getNotCompleted($updateStatusData->sub->group_id)
            ->each(static fn (Income $income) => $income->update([
                'message' => $updateStatusData->message,
                'status' => $updateStatusData->status,
                'wallet_id' => $updateStatusData->wallet?->wallet_id,
            ]));
    }
}
