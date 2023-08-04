<?php

declare(strict_types=1);

namespace App\Events;

use App\Dto\FinanceData;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\Internal\IncomeService;
use Illuminate\Foundation\Events\Dispatchable;

class PayoutCompleteEvent
{
    use Dispatchable;

    public function __construct(
        public readonly Sub $sub,
        public readonly Wallet $wallet,
        public readonly float $payout,
        public readonly string $txId,
    ) {}
}
