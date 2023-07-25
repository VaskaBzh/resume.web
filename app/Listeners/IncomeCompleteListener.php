<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\Finance\Create;

class IncomeCompleteListener
{
    public function __construct()
    {
    }

    public function handle($event): void
    {
        Create::execute($event->financeData);
    }
}
