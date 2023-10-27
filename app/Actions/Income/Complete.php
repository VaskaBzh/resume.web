<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\IncomeCompleteData;
use Illuminate\Database\Eloquent\Collection;

class Complete
{
    public static function execute(Collection $incomes, IncomeCompleteData $incomeCompleteData): void
    {
        foreach ($incomes as $income) {
            $income->update([
                'message' => $incomeCompleteData->message,
                'status' => $incomeCompleteData->status,
            ]);
        }
    }
}
