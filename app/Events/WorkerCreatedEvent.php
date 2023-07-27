<?php

declare(strict_types=1);

namespace App\Events;

use App\Dto\WorkerData;
use Illuminate\Foundation\Events\Dispatchable;

class WorkerCreatedEvent
{
    use Dispatchable;

    public function __construct(public WorkerData $workerData)
    {}
}
