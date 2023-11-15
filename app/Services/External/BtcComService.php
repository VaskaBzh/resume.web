<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Actions\Sub\Create;
use App\Actions\Worker\Create as WorkerCreate;
use App\Actions\Worker\Update;
use App\Dto\Sub\SubData;
use App\Dto\WorkerData;
use App\Dto\WorkerHashRateData;
use App\Exceptions\BusinessException;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
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
     *
     * @throws \Exception
     */
    public function call(array $segments, string $method = 'get', array $params = []): array
    {
        $client = Http::baseUrl(
            url: config('api.btc.url')
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
     */
    public function getGroupList(): Collection
    {
        $response = $this->call(
            segments: ['worker', 'groups'],
            params: [
                'puid' => self::PU_ID,
                'page_size' => self::DEFAULT_PAGE_SIZE,
            ]
        );

        return collect($response['list'] ?? []);
    }

    /**
     * Get remote sub-account
     */
    public function getSub(int $groupId): ?array
    {
        return $this->call(segments: ['groups', $groupId], params: [
            'puid' => self::PU_ID,
        ]);
    }

    /**
     * Create remote sub-account by user name
     */
    public function createRemoteSub(string $subName): array
    {
        $btcComSub = $this->call(
            segments: ['groups', 'create'],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_name' => $subName,
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
     * Create remote sub-account
     * Create local sub-account based on remote sub-account group_id
     */
    public function createLocalSub(
        User $user,
        string $subName,
        bool $isActive = true
    ): void {
        $remoteSub = $this->createRemoteSub(subName: $subName);

        Create::execute(
            subData: SubData::fromRequest([
                'user_id' => $user->id,
                'group_id' => $remoteSub['gid'],
                'sub_name' => $subName,
                'is_active' => $isActive,
            ])
        );
    }

    /**
     *  Get remote worker list by status
     *
     * @throws \Exception
     */
    public function getWorkerList(
        ?int $groupId = 0,
        ?string $workerStatus = 'all'
    ): Collection {
        $response = $this->call(
            segments: ['worker'],
            params: [
                'puid' => self::PU_ID,
                'group' => $groupId,
                'page_size' => self::DEFAULT_PAGE_SIZE,
                'status' => $workerStatus,
            ]
        );

        return collect($response['data'] ?? []);
    }

    /**
     * Update remote worker group
     */
    public function updateRemoteWorker(int $workerId, int $groupId): void
    {
        $this->call(
            segments: [
                'worker',
                'update',
            ],
            method: 'post',
            params: [
                'puid' => self::PU_ID,
                'group_id' => $groupId,
                'worker_id' => (string) $workerId,
            ]);
    }

    /**
     * Get btc.com fpps rate
     *
     * @throws \Exception
     */
    public function getFppsRate(): float|int
    {
        $fppsRate = $this->call(['account', 'earn-history'], params: [
            'puid' => self::PU_ID,
            'page_size' => '1',
        ])['list'];

        return collect($fppsRate)->first()['more_than_pps96_rate'];
    }

    /* End requests */

    /**
     * Transform remote sub-account to local structure
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
     */
    public function filterUngrouped(): Collection
    {
        return $this
            ->getGroupList()
            ->filter(static fn (array $groups, int $index) => $index > 1);
    }

    /**
     * Sync local worker state based on remote one
     */
    public function updateLocalWorkers(): void
    {
        $onlineWorkers = $this->getWorkerList();
        $deadWorkers = $this->getWorkerList(0, 'dead');

        $this->transformRemoteGroupedWorkers(
            btcComWorkers: collect([...$deadWorkers, ...$onlineWorkers])
        )->each(static function (WorkerData $workerData) {

            Update::execute(workerData: $workerData);
        });

        Log::channel('commands')->info('WORKERS UPDATE COMPLETE');
    }

    /**
     * Get remote worker and create local
     *
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
                    'hash' => (int) $firstWorkerData['worker_hash_rate']->hash,
                    'unit' => $firstWorkerData['worker_hash_rate']->unit,
                ]);

            $this->updateRemoteWorker(
                workerId: $firstWorkerData['worker_data']->worker_id,
                groupId: $firstWorkerData['worker_data']->group_id
            );
        });

        Log::channel('commands')->info('WORKERS IMPORT COMPLETE');
    }

    /**
     * Transform remote workers to local structure
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
                    'pool_data' => $btcComWorker,
                ]);
            }
        })->filter();
    }

    /**
     * Transform remote worker list to local structure with first hash rates
     */
    public function transformRemoteUngroupedWorkers(
        EloquentCollection $subs,
        Collection $btcComWorkers
    ): Collection {
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
                        'pool_data' => $btcComWorker,
                    ]),
                ];
            }
        })->filter();
    }

    /**
     * Return transformed sub-account array structure
     */
    private static function transform(Sub $sub, array $btcComSub): array
    {
        $hashPerDay = $sub->converted_hash_rate;
        $workers = $sub->workers;

        return [
            'sub' => $sub->sub,
            'user_id' => $sub->user_id,
            'pending_amount' => $sub->pending_amount,
            'group_id' => $sub->group_id,
            'workers_count_active' => $workers
                ->where('status', 'ACTIVE')
                ->count(),
            'workers_count_inactive' => $workers
                ->where('status', 'INACTIVE')
                ->count(),
            'workers_count_unstable' => $workers
                ->where('status', 'DEAD')
                ->count(),
            'hash_per_min' => (float) $btcComSub['shares_1m'],
            'hash_per_day' => $hashPerDay->value,
            'today_forecast' => $sub->todayForecast($sub->hash_rate, self::FEE + $sub->allbtc_fee),
            'reject_percent' => $btcComSub['reject_percent'],
            'hash_per_day_unit' => $hashPerDay->unit,
            'hash_per_min_unit' => $btcComSub['shares_unit'],
            'total_payout' => $sub->total_payout,
            'yesterday_amount' => $sub->yesterday_amount,
            'last_month_amount' => $sub->lastMonthIncomes()->sum('daily_amount'),
            'total_amount' => $sub->total_amount,
        ];
    }
}
