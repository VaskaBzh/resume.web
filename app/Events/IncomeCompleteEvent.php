<?php

declare(strict_types=1);

namespace App\Events;

use App\Dto\FinanceData;
use App\Models\Sub;
use App\Services\Internal\IncomeService;
use Illuminate\Foundation\Events\Dispatchable;

class IncomeCompleteEvent
{
    use Dispatchable;

    public function __construct(
        private readonly Sub $sub,
        private readonly float $earn
    ) {
        $profit = ($earn / 100) * IncomeService::ALLBTC_FEE;

        $this->financeData = FinanceData::fromRequest([
            'group_id' => $this->sub->group_id,
            'earn' => $earn,
            'user_total' => $earn - $profit,
            'percent' => IncomeService::ALLBTC_FEE,
            'profit' => $profit
        ]);
    }
}
