<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Models\Worker;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;

final readonly class WorkerService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $transform,
    ) {
    }

    public function handleWorkers()
    {
        $remoteWorkers = $this->client->getWorkerList();

        $transformed = $this->transform->transformCollection($remoteWorkers, Worker::class);
   }
}
