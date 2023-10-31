<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Actions\Worker\Update;
use App\Actions\Worker\Create as WorkerCreate;
use App\Dto\SubData;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
use App\Exceptions\BusinessException;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BtcComService
{
    private static int $pendingTimeSec = 1;
    private const DEFAULT_PAGE_SIZE = 1000;
    private const PU_ID = 781195;
    private const UNGROUPED_ID = -1;
    public const FEE = 0.5;

    /* ------------------ Btc.com requests ------------------------ */

    /**
     * Call btc.com
     *
     * @param array $segments
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function call(array $segments, string $method = 'get', array $params = []): array
    {
        $client = Http::baseUrl(
            url: config('api.btc.uri')
        )->withHeaders(
            headers: ['Authorization' => config('api.btc.token')]
        );

        $retryCount = 3;

        while ($retryCount > 0) {
            $response = $client->$method(implode('/', $segments), $params);

            if (isset($response['data'])) {

                return $response['data'];
            }

            $retryCount--;

            sleep(self::$pendingTimeSec);
        }

        return [];
    }

    /**
     * Get remote sub-account list
     *
     */
    public function getGroupList(): Collection
    {
        $response = $this->call(
            segments: ['worker', 'groups'],
            params: [
                'puid' => self::PU_ID,
                "page_size" => self::DEFAULT_PAGE_SIZE,
            ]
        );

        return collect($response['list'] ?? []);
    }

    /**
     * Get remote sub-account
     *
     */
    public function getSub(int $groupId): ?array
    {
        return $this->call(segments: ['groups', $groupId], params: [
            'puid' => self::PU_ID,
        ]);
    }

    /**
     * Create remote sub-account by user name
     *
     */
    public function createRemoteSub(string $subName): array
    {
        $btcComSub = $this->call(
            segments: ['groups', 'create'],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_name' => $subName
            ]);

        if (in_array('exist', $btcComSub, true)) {

            throw new BusinessException(
                __('actions.sub_account_already_exist'),
                Response::HTTP_BAD_REQUEST
            );
        }

        return $btcComSub;
    }

    /**
     * Create local sub based on remote sub-account group_id
     *
     * @throw BusinessException if remote sub-account exists
     */
    public function createSub(int $userId, string $subName): Sub
    {
        return Create::execute(
            subData: SubData::fromRequest([
                'user_id' => $userId,
                'group_id' => 777777,
                'group_name' => $subName,
            ])
        );
    }

    /**
     *  Get remote worker list by status
     *
     * @param int|null $groupId
     * @param string|null $workerStatus
     * @return Collection
     * @throws \Exception
     */
    public function getWorkerList(
        ?int    $groupId = 0,
        ?string $workerStatus = 'all'
    ): Collection
    {
        $response = $this->call(
            segments: ['worker'],
            params: [
                'puid' => self::PU_ID,
                'group' => $groupId,
                'page_size' => self::DEFAULT_PAGE_SIZE,
                'status' => $workerStatus
            ]
        );

        return collect($response['data'] ?? []);
    }

    /**
     * Update remote worker group
     *
     */
    public function updateRemoteWorker(int $workerId, int $groupId): void
    {
        $this->call(
            segments: [
                'worker',
                'update'
            ],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_id' => $groupId,
                'worker_id' => (string)$workerId
            ]);
    }

    /**
     * Get btc.com fpps rate
     *
     * @return float|int
     * @throws \Exception
     */
    public function getFppsRate(): float|int
    {
        $fppsRate = $this->call(['account', 'earn-history'], params: [
            'puid' => self::PU_ID,
            "page_size" => "1",
        ])['list'];

        return collect($fppsRate)->first()['more_than_pps96_rate'];
    }

    /* End requests */

    /**
     * Transform remote sub-account to local structure
     *
     * @param Sub $sub
     * @return array
     */
    public function transformSub(Sub $sub): array
    {
        return self::transform(
            sub: $sub,
            btcComSub: $this->getSub($sub->group_id)
        );
    }

    /**
     * Transform remote sub-account list to local structure
     *
     * @param Collection $subs
     * @return Collection
     */
    public function transformSubCollection(Collection $subs): Collection
    {
        return $this
            ->filterUngrouped()
            ->whereIn('gid', $subs->pluck('group_id')->toArray())
            ->map(static function (array $btcComSub) use ($subs) {
                foreach ($subs as $sub) {
                    if (in_array($sub->group_id, $btcComSub)) {

                        return self::transform($sub, $btcComSub);
                    }
                }
            })->filter();
    }

    /**
     * Get sub-account list and filter -1 & 0 groups
     *
     * @return Collection
     */
    public function filterUngrouped(): Collection
    {
        return $this
            ->getGroupList()
            ->filter(static fn(array $groups, int $index) => $index > 1);
    }

    /**
     * Sync local worker state based on remote one
     *
     */
    public function updateLocalWorkers(): void
    {
        $groupedWorkerIDs = $this->transformRemoteGroupedWorkers(
            btcComWorkers: $this->getWorkerList()
        )->each(static fn(WorkerData $workerData) => Update::execute(workerData: $workerData))
            ->pluck('worker_id')
            ->toArray();

        Worker::whereNotIn(
            column: 'worker_id',
            values: $groupedWorkerIDs
        )->delete();

        Log::channel('commands')->info('WORKERS UPDATE COMPLETE');
    }

    /**
     * Get remote worker and create local
     *
     * @return void
     * @throws \Exception
     */
    public function createLocalWorkers(): void
    {
        $this->transformRemoteUngroupedWorkers(
            subs: Sub::all(),
            btcComWorkers: $this->getWorkerList(self::UNGROUPED_ID),
        )->each(function (array $firstWorkerData) {

            WorkerCreate::execute($firstWorkerData['worker_data'])
                ->workerHashrates()
                ->create([
                    'hash' => (int)$firstWorkerData['worker_hash_rate']->hash,
                    'unit' => $firstWorkerData['worker_hash_rate']->unit,
                ]);;

            $this->updateRemoteWorker(
                workerId: $firstWorkerData['worker_data']->worker_id,
                groupId: $firstWorkerData['worker_data']->group_id
            );
        });

        Log::channel('commands')->info('WORKERS IMPORT COMPLETE');
    }

    /**
     * Transform remote workers to local structure
     *
     * @return Collection
     */
    public function transformRemoteGroupedWorkers(Collection $btcComWorkers): Collection
    {
        return $btcComWorkers->map(static function (array $btcComWorker) {
            if (filled($btcComWorker)) {
                return WorkerData::fromRequest(requestData: [
                    'group_id' => $btcComWorker['gid'],
                    'worker_id' => $btcComWorker['worker_id'],
                    'name' => $btcComWorker['worker_name'],
                    'approximate_hash_rate' => $btcComWorker['shares_1d'],
                    'status' => $btcComWorker['status'],
                    'unit' => $btcComWorker['shares_unit'],
                    'pool_data' => $btcComWorker
                ]);
            }
        })->filter();
    }

    /**
     * Transform remote worker list to local structure with first hash rates
     *
     * @param EloquentCollection $subs
     * @param Collection $btcComWorkers
     * @return Collection
     */
    public function transformRemoteUngroupedWorkers(
        EloquentCollection $subs,
        Collection         $btcComWorkers
    ): Collection
    {
        return $btcComWorkers->map(static function (array $btcComWorker) use ($subs) {

            $subName = head(explode('.', $btcComWorker['worker_name'] ?? ''));

            if ($groupId = $subs->firstWhere('sub', $subName)?->group_id) {

                return [
                    'worker_hash_rate' => WorkerHashRateData::fromRequest(requestData: [
                        'worker_id' => $btcComWorker['worker_id'],
                        'hash' => $btcComWorker['shares_1m'],
                        'unit' => $btcComWorker['shares_unit'],
                    ]),
                    'worker_data' => WorkerData::fromRequest(requestData: [
                        'group_id' => $groupId,
                        'worker_id' => $btcComWorker['worker_id'],
                        'name' => $btcComWorker['worker_name'],
                        'approximate_hash_rate' => $btcComWorker['shares_1m'],
                        'status' => $btcComWorker['status'],
                        'unit' => $btcComWorker['shares_unit'],
                        'pool_data' => $btcComWorker
                    ]),
                ];
            }
        })->filter();
    }


    /**
     * Return transformed sub-account array structure
     *
     * @param Sub $sub
     * @param array $btcComSub
     * @return array
     */
    private static function transform(Sub $sub, array $btcComSub): array
    {
        $hashPerDay = $sub->total_hash_rate;

        return [
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'workers_count_active' => $btcComSub['workers_active'],
            'workers_count_in_active' => $btcComSub['workers_inactive'],
            'workers_count_unstable' => $btcComSub['workers_dead'],
            'hash_per_min' => (float)$btcComSub['shares_1m'],
            'hash_per_day' => $hashPerDay,
            'today_forecast' => $sub->todayForecast($hashPerDay, self::FEE),
            'reject_percent' => (float)$btcComSub['reject_percent'],
            'unit' => $btcComSub['shares_unit'],
            'total_payout' => $sub->total_payout,
            'yesterday_amount' => (float)$sub->yesterday_amount,
        ];
    }
}
