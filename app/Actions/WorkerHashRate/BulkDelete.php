<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\WorkerHashrate;
use Illuminate\Database\Eloquent\Collection;

class BulkDelete
{
    public static function execute(Collection $hashRates)
    {
        $hashRates->each(static fn(WorkerHashrate $hashrate) => $hashrate->delete());
    }
}
