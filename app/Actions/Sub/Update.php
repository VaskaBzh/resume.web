<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Dto\SubData;
use App\Models\Sub;

class Update
{
    public static function execute(SubData $subData, Sub $sub): void
    {
        $sub->update(
            [
                'sub' => $subData->groupName,
                'total_payment' => $subData->totalPayment ?? $sub->total_payment,
                'un_payments' => $subData->accumulateAmount ?? $sub->un_payments,
                'total_amount' => $subData->totalAmount ?? $sub->total_amount,
            ]
        );
    }
}
