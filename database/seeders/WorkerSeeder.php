<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\Worker\Update;
use App\Dto\WorkerData;
use App\Models\WorkerHashrate;
use App\Services\External\BtcCom\Client;
use App\Services\External\TransformContract;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    public function run(Client $client, TransformContract $transformer): void
    {
        $remoteWorkers = $client->getWorkerList(6001912);

        $remoteWorkers->map(function (array $remoteWorker) use ($transformer) {
            return $transformer->transformWorker($remoteWorker);
        })->each(static function (WorkerData $workerData) {
            Update::execute($workerData);

            WorkerHashrate::create([
                'worker_id' => $workerData->workerId,
                'hash_per_min' => $workerData->hashPerMin,
                'unit' => $workerData->unitPerMin,
            ]);
        });
    }
}
