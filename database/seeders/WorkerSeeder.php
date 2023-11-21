<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\Worker\Update;
use App\Dto\WorkerData;
use App\Models\Worker;
use App\Models\WorkerHashrate;
use App\Services\External\BtcCom\Client;
use App\Services\External\Contracts\TransformContract;
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

        Worker::updateOrCreate([
            'worker_id' => 1000000000,
        ], [
            'worker_id' => 1000000000,
            'group_id' => 9999999,
            'name' => 'Referral.1',
            'hash_per_day' => 89760000000000,
            'status' => 'ACTIVE',
            'unit' => 'T',
            'pool_data' => [],
        ]);

        Worker::updateOrCreate([
            'worker_id' => 1100000000,
        ], [
            'worker_id' => 1100000000,
            'group_id' => 9999999,
            'name' => 'Referral.1',
            'hash_per_day' => 89760000000000,
            'status' => 'ACTIVE',
            'unit' => 'T',
            'pool_data' => [],
        ]);
    }
}
