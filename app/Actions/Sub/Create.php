<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Dto\SubData;
use App\Models\Sub;

class Create
{
    public static function execute(SubData $subData): void
    {
        Sub::create([
            'user_id' => $subData->userId,
            'group_id' => $subData->groupId,
            'sub' => $subData->groupName,
            'payments' => $subData->payments,
            'unPayments' => $subData->unPayments,
            'accruals' => $subData->accruals,
        ]);
    }
}