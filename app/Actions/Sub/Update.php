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
            ['group_id' => $subData->groupId],
            [
                'sub' => $subData->groupName,
                'payments' => $subData->payments ?? $sub->payments,
                'unPayments' => $subData->unPayments ?? $sub->unPayments,
                'accruals' => $subData->accruals ?? $sub->accruals,
            ]
        );
    }
}
