<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Worker\Create;
use App\Actions\Worker\Update;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Services\External\ClientContract;
use App\Services\External\TransformContract;
use Illuminate\Support\Collection;

final readonly class WorkerService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $transform,
    ) {
    }

    /**
     * Get remote workers and update all local workers
     */
    public function sync(int $groupId, string $status): Collection
    {
        $remoteWorkers = $this->client
            ->getWorkerList($groupId, $status);

        $localSubs = Sub::whereIn('group_id', $remoteWorkers->pluck('gid'))
            ->pluck('group_id');

        return $remoteWorkers
            ->filter(static fn (array $data) => in_array($data['gid'], $localSubs->toArray(), true))
            ->map(fn (array $data) => $this->transform->transformWorker($data))
            ->each(fn (WorkerData $workerData) => Update::execute(workerData: $workerData));
    }

    /**
     *  Add new workers by group_id
     */
    public function addNew(int $groupId): Collection
    {
        $newRemoteWorkers = $this->client->getWorkerList($groupId);

        $transformed = $newRemoteWorkers->map(fn (array $data) => $this->transform->transformWorker($data));

        $workerNames = $transformed
            ->map(static fn (WorkerData $data) => head(explode('.', $data->name)));

        $owners = Sub::whereNameIn($workerNames)->get();

        $newLocalWorkers = $transformed->map(function (WorkerData $data) use ($owners) {
            if ($owner = $owners->firstWhere('sub', head(explode('.', $data->name)))) {

                return Create::execute($owner, $data);
            }
        })->filter();

        $this->client->updateRemoteWorkers($newLocalWorkers);

        return $newLocalWorkers;
    }
}
