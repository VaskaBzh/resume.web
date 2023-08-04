<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\IncomeData;
use App\Models\Income;

class Create
{
    public static function execute(IncomeData $incomeData): Income
    {
        return Income::create([
            'group_id' => $incomeData->groupId,
            'txid' => $incomeData->txid,
            'wallet' => $incomeData->wallet,
            'daily_amount' => $incomeData->dailyAmount,
            'unit' => $incomeData->unit,
            'status' => $incomeData->status,
            'message' => $incomeData->message,
            'hash' => $incomeData->hashrate,
            'diff' => $incomeData->difficulty,
        ]);
    }
}
