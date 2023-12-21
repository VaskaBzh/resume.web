<?php

declare(strict_types=1);

namespace App\Services\Internal\Income;

use App\Actions\Finance\Create as FinanceCreate;
use App\Actions\Income\Create as IncomeCreate;
use App\Actions\Income\UpdateStatus;
use App\Dto\DtoContract;
use App\Dto\FinanceData;
use App\Dto\Income\UpdateStatusData;
use App\Enums\Income\Type;
use Illuminate\Support\Facades\Log;

readonly class ServiceIncome
{
    private function __construct(private IncomeContract $income)
    {
    }

    public static function withIncome(IncomeContract $income)
    {
        return new self($income);
    }

    public function store(DtoContract $incomeCreateData): void
    {
        IncomeCreate::execute($incomeCreateData);

        $this->updateIncomes(
            data: UpdateStatusData::fromArray([
                'sub' => $incomeCreateData->sub,
                'wallet' => $incomeCreateData->wallet,
                'status' => $incomeCreateData->status,
            ])
        );

        FinanceCreate::execute(financeData: FinanceData::fromArray([
            'group_id' => $incomeCreateData->sub->group_id,
            'earn' => $this->dailyEarn - $this->dailyEarn * (config('api.btc.fee') / 100),
            'user_total' => $this->params[Type::MINING->value]['dailyAmount'],
            'percent' => $this->fee,
            'profit' => $this->dailyEarn * ($this->fee / 100),
        ]));

        Log::channel('commands.incomes')->info(
            message: sprintf('INCOME CREATED. TYPE: %s', Type::MINING->value),
            context: get_object_vars($incomeCreateData),
        );
    }

    public function updateIncomes(DtoContract $data): void
    {
        UpdateStatus::execute(updateStatusData: $data);
    }
}
