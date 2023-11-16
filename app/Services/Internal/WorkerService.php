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
use Illuminate\Database\Eloquent\Builder;
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

    public function add()
    {
        $newWorkers = $this->client->getWorkerList();

        if ($newWorkers->isNotEmpty()) {

            $transformed = $this->transform->transformCollection(
                collection: $newWorkers,
                className: Worker::class
            );

            $workerNames = $transformed
                ->pluck('name')
                ->map(static function (string $name) {
                    return head(explode('.', $name));
                });

            Sub::whereNameIn($workerNames)
                ->get()
                ->each(function (Sub $sub) use ($transformed) {
                    dd($transformed);
                    $worker = $transformed->where('name', $sub->sub);
                    dd($worker);
                });

        }

    }
}
