<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\IncomeData;
use Illuminate\Database\Eloquent\Collection;

class Complete
{
    public static function execute(Collection $incomes, IncomeData $incomeData): void
    {
        foreach ($incomes as $income) {
            $income->update([
                'message' => $incomeData->message,
                'status' => $incomeData->status,
            ]);
        }
    }
}
