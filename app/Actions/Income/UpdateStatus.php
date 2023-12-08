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
                'payout_id' => $updateStatusData->payout->id,
                'status' => $updateStatusData->status->value,
                'wallet_id' => $updateStatusData->wallet?->wallet_id,
            ]));
    }
}
