<?php

declare(strict_types=1);

namespace App\Actions\Income;

use App\Dto\Income\IncomeCreateData;
use App\Dto\Income\UpdateStatusData;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class Create
{
    public static function execute(IncomeCreateData $incomeCreateData): ?Income
    {
        try {
            DB::beginTransaction();

            /**
             * @var Income $income
             */
            $income = Income::create([
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
dd($income);
            UpdateStatus::execute(
                updateStatusData: UpdateStatusData::fromArray([
                    'sub' => $incomeCreateData->sub,
                    'status' => $incomeCreateData->status,
                ])
            );

            DB::commit();

            return $income;
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();

            return null;
        }
    }
}
