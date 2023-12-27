<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Worker\Create;
use App\Actions\Worker\Update;
use App\Actions\WorkerHashRate\Create as HashRateCreate;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\Worker;
use App\Services\External\BtcCom\ClientContract;
use App\Services\External\BtcCom\TransformContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
            ->each(static fn (WorkerData $workerData) => Update::execute(workerData: $workerData));
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

                $worker = Create::execute($owner, $data);

                $this->log($data, 'added');

                return $worker;
            }
        })->filter();

        $this->client->updateRemoteWorkers($newLocalWorkers);

        return $newLocalWorkers;
    }

    public function createHashes(int $groupId): void
    {
        $remoteWorkers = $this->client->getWorkerList($groupId)
            ->filter(static fn (array $remoteWorker) => Arr::get($remoteWorker, 'shares_1m_pure', 0) > 0);

        $localWorkers = Worker::whereIn('worker_id', $remoteWorkers->pluck('worker_id'))->get();

        $remoteWorkers->each(function (array $remoteWorker) use ($localWorkers) {
            if ($localWorker = $localWorkers->where('worker_id', $remoteWorker['worker_id'])->first()) {
                HashRateCreate::execute($localWorker, [
                    'hash_rate_per_min' => $remoteWorker['shares_1m_pure'],
                    'unit' => $remoteWorker['shares_unit'],
                ]);
            }
        });
    }

    private function log(WorkerData $data, string $action): void
    {
        Log::channel('commands.workers')->info(
            message: Str::upper($action),
            context: ['worker_name' => $data->name, 'worker_id' => $data->workerId]
        );
    }
}
