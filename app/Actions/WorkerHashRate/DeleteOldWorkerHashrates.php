<?php

declare(strict_types=1);

namespace App\Actions\WorkerHashRate;

use App\Models\WorkerHashrate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class DeleteOldWorkerHashrates
{
    public static function execute(Builder $query): void
    {
        $query->delete();
    }
}
