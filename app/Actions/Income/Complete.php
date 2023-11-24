<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\CompleteData;
use Illuminate\Database\Eloquent\Collection;

class Complete
{
    public static function execute(
        Collection $incomes,
        CompleteData $incomeCompleteData
    ): void {
        $incomes->each(static fn ($income) => $income->update([
            'message' => $incomeCompleteData->message,
            'status' => $incomeCompleteData->status,
            'wallet_id' => $incomeCompleteData->wallet?->wallet_id,
        ]));
    }
}
