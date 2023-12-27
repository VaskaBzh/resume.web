<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\WorkerHashrate;

class DeleteOld
{
    public static function execute(): void
    {
        WorkerHashrate::oldestThan(date: now()->subMonth())->delete();
    }
}
