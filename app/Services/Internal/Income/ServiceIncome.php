<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Actions\Income\UpdateStatus;
use App\Dto\Income\UpdateStatusData;
use App\Models\Income;
use Illuminate\Support\Facades\Log;

class ServiceIncome
{
    public static function store(IncomeContract $income): Income
    {
        $income = $income
            ->setFee()
            ->setEarn()
            ->setAmount()
            ->store();

        Log::channel('commands.incomes')->info(
            message: sprintf('INCOME CREATED. TYPE: %s', $income->type),
            context: $income?->toArray()
        );

        return $income;
    }

    public static function updateIncomes(UpdateStatusData $data): void
    {
        UpdateStatus::execute(updateStatusData: $data);
    }
}
