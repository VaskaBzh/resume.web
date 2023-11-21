<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Dto\Sub\SubUpsertData;
use App\Models\Sub;

class Create
{
    public static function execute(SubUpsertData $subData): Sub
    {
        return Sub::create([
            'user_id' => $subData->userId,
            'group_id' => $subData->groupId,
            'sub' => $subData->subName,
            'pending_amount' => $subData->pendingAmount,
            'total_amount' => $subData->totalAmount,
        ]);
    }
}
