<?php

namespace Database\Seeders;

use App\Dto\WorkerData;
use App\Models\Worker;
use App\Services\External\BtcCom\Client;
use App\Services\External\TransformContract;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    public function run(Client $client, TransformContract $transformer): void
    {
        $remoteWorkers = $client->getWorkerList(6001912);

        $workers = $transformer->transformCollection($remoteWorkers, Worker::class);
        $workers->each(static function (WorkerData $workerData) {
            Worker::updateOrCreate(['worker_id' => $workerData->workerId], [
                'group_id' => $workerData->groupId,
                'name' => $workerData->name,
                'worker_id' => $workerData->workerId,
                'hash_per_day' => $workerData->hashPerDay,
                'status' => $workerData->status,
                'unit' => $workerData->unitPerDay,
                'pool_data' => $workerData->poolData,
            ])
                ->workerHashrates()
                ->create([
                    'hash_per_min' => $workerData->hashPerMin,
                    'unit' => $workerData->unitPerMin,
                ]);
        });
    }
}
