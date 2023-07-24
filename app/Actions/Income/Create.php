<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\IncomeData;
use App\Models\Income;

class Create
{
    public static function execute(IncomeData $incomeData): void
    {
        Income::create([
            'group_id' => $incomeData->groupId,
            'percent' => $incomeData->percent,
            'txid' => $incomeData->txid,
            'wallet' => $incomeData->wallet,
            'payment' => $incomeData->payment,
            'amount' => $incomeData->amount,
            'unit' => $incomeData->unit,
            'status' => $incomeData->status,
            'message' => $incomeData->message,
            'hash' => $incomeData->hash,
            'diff' => $incomeData->diff,
        ]);
    }
}
