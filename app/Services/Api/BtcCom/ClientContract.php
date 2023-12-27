<?php

declare(strict_types=1);

namespace App\Services\Api\BtcCom;

use Illuminate\Support\Collection;

interface ClientContract
{
    /**
     * Get remote sub-account
     */
    public function getSub(int $groupId): Collection;

    /**
     * Get remote sub-account list
     */
    public function getSubList(): Collection;

    /**
     * Create remote sub-account by user name
     */
    public function createRemoteSub(string $subName): Collection;

    /**
     *  Get remote worker list by status & group_id
     *
     * @param  ?string  $workerStatus
     *
     * @throws \Exception
     */
    public function getWorkerList(int $groupId, ?string $workerStatus = 'all'): Collection;

    public function updateRemoteWorkers(Collection $data): void;

    public function getFppsRate(): float|int;
}
