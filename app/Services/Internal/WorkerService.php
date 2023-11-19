<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Worker\Create;
use App\Actions\Worker\Update;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\Worker;
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
        $localSubs = Sub::pluck('group_id');

        $localSubWorkers = $this->client
            ->getWorkerList($groupId, $status)
            ->filter(static fn (array $data) => $localSubs->contains($data['gid']));

        return $this->transform
            ->transformCollection(collection: $localSubWorkers, itemType: Worker::class)
            ->each(static fn (WorkerData $workerData) => Update::execute(workerData: $workerData));
    }

    /**
     *  Add new workers by group_id
     */
    public function addNew(int $groupId): Collection
    {
        $newRemoteWorkers = $this->client->getWorkerList($groupId);

        $transformed = $this->transform->transformCollection(
            collection: $newRemoteWorkers,
            itemType: Worker::class
        );

        $workerNames = $transformed
            ->map(static fn (WorkerData $data) => head(explode('.', $data->name)));

        $owners = Sub::whereNameIn($workerNames)->get();

        $newLocalWorkerIDs = $transformed->map(function (WorkerData $data) use ($owners) {
            if ($owner = $owners->firstWhere('sub', head(explode('.', $data->name)))) {

                $newLocalWorker = Create::execute($owner, $data);

                return [
                    'workerId' => $newLocalWorker->worker_id,
                    'groupId' => $newLocalWorker->group_id,
                ];
            }
        })->filter();

        $this->client->updateRemoteWorkers($newLocalWorkerIDs);

        return $newLocalWorkerIDs;
    }
}
