<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Actions\Executable;
use App\Dto\DtoContract;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class Create implements Executable
{
    public static function execute(DtoContract $incomeCreateData): void
    {
        try {
            DB::beginTransaction();

            /**
             * @var Income $income
             */
            Income::create([
                'group_id' => $incomeCreateData->sub->group_id,
                'type' => $incomeCreateData->type->value,
                'wallet_id' => $incomeCreateData->wallet?->id,
                'referral_id' => $incomeCreateData->referralId,
                'daily_amount' => $incomeCreateData->dailyAmount,
                'status' => $incomeCreateData->status->value,
                'message' => $incomeCreateData->message?->value,
                'hash' => $incomeCreateData->hashrate->value,
                'unit' => $incomeCreateData->hashrate->unit,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
    }
}
