<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Actions\Finance\Create as FinanceCreate;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Income\UpdateStatus;
use App\Dto\FinanceData;
use App\Dto\Income\UpdateStatusData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

readonly class ServiceIncome
{
    public function store(IncomeContract $income): void
    {
        try {
            DB::beginTransaction();

            IncomeCreate::execute($income->dto());

            $this->updateIncomes(UpdateStatusData::fromArray([
                'sub' => $income->dto()->sub,
                'status' => $income->dto()->status,
            ]));

            DB::commit();
        } catch (\Throwable $e) {
            report($e);

            DB::rollBack();
        }

        Log::channel('commands.incomes')->info(
            message: sprintf('INCOME CREATED. TYPE: %s', $income->dto()->type->value),
            context: get_object_vars($income->dto()),
        );
    }

    public function updateIncomes(UpdateStatusData $updateStatusData): void
    {
        UpdateStatus::execute(updateStatusData: $updateStatusData);
    }

    public function createFinance(IncomeContract $income): void
    {
        FinanceCreate::execute(financeData: FinanceData::fromArray([
            'group_id' => $income->dto()->sub->group_id,
            'earn' => $income->getEarn() - $income->getEarn() * (config('api.btc.fee') / 100),
            'user_total' => $income->getAmount(),
            'percent' => $income->getFee(),
            'profit' => $income->getEarn() * ($income->getFee() / 100),
        ]));
    }
}
