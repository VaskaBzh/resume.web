<?php

declare(strict_types=1);

namespace App\Services\Income;

use App\Actions\Finance\Create as FinanceCreate;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Income\UpdateStatus;
use App\Dto\DtoContract;
use App\Dto\FinanceData;
use App\Dto\Income\UpdateStatusData;
use App\Exceptions\CalculatingException;
use App\Models\Sub;
use App\Services\Income\Types\MiningIncome;
use App\Services\Income\Types\ReferralIncome;
use App\Services\SubService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class IncomeService
{
    /**
     * @throws CalculatingException
     */
    public function localSubProcess(Sub $sub): void
    {
        $referrerActiveSub = $sub->user
            ->referrer
            ?->activeSub()
            ->first();

        $miningIncome = MiningIncome::make($sub);
        SubService::updateAmounts($sub, $miningIncome->getAmount());

        $this->store($miningIncome);
        $this->createFinance($miningIncome);

        if ($referrerActiveSub) {
            $referralIncome = ReferralIncome::make($sub);
            SubService::updateAmounts($referrerActiveSub, $referralIncome->getAmount());
            $this->store($referralIncome);
        }
    }

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

        $this->log($income->dto());
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

    private function log(DtoContract $income): void
    {
        Log::channel('commands.incomes')->info(
            message: "INCOME CREATED.\n
            TYPE: {$income->type->value})\n
            AMOUNT: {$income->dailyAmount}\n
            SUB: {$income->sub->group_id}",
        );
    }
}
