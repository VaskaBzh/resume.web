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
use Illuminate\Support\Facades\Log;

final readonly class WorkerService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $transform,
    ) {
    }

    public function sync(): void
    {
        $onlineWorkers = $this->client->getWorkerList();
        $deadWorkers = $this->client->getWorkerList(0, 'dead');

        $updatedCount = $this->transform->transformCollection(
            collection: collect([...$onlineWorkers, ...$deadWorkers]),
            className: Worker::class
        )->each(static function (WorkerData $workerData) {

            Update::execute(workerData: $workerData);
        })->count();

        Log::channel('commands')->info(sprintf('WORKERS UPDATE COMPLETE. COUNT: %s', $updatedCount));
    }

    public function add(): void
    {
        $newRemoteWorkers = $this->client->getWorkerList(); // TODO: SET UNGROUPED ID

        if ($newRemoteWorkers->isNotEmpty()) {

            $transformed = $this->transform->transformCollection(
                collection: $newRemoteWorkers,
                className: Worker::class
            );

            $workerNames = $transformed
                ->map(
                    static fn (WorkerData $data) => head(explode('.', $data->name))
                );

            $owners = Sub::whereNameIn($workerNames)->get();

            $newLocalWorkers = $transformed->each(function (WorkerData $data) use ($owners) {
                if ($owner = $owners->firstWhere('sub', head(explode('.', $data->name)))) {

                 dump($data);
                }
            });
            dd('s');
            dd($newLocalWorkers);
            $this->client->updateRemoteWorker($newLocalWorkers->only(''));
        }

    }
}
