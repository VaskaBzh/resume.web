<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Hashes\DeleteOldHashrates;
use App\Actions\Sub\Create;
use App\Dto\Sub\SubsOverallData;
use App\Dto\Sub\SubUpsertData;
use App\Dto\Sub\SubViewData;
use App\Models\Hash;
use App\Models\Sub;
use App\Models\User;
use App\Services\External\Contracts\ClientContract;
use App\Services\External\Contracts\TransformContract;
use Illuminate\Support\Collection;

final readonly class SubService
{
    public function __construct(
        private ClientContract $client,
        private TransformContract $transform,
    ) {
    }

    private static function withLocal(Collection $userIds, Collection $groupIds): Collection
    {
        return Sub::whereIn('user_id', $userIds)
            ->whereIn('group_id', $groupIds)
            ->with('workers')
            ->get();
    }

    public function getSub(Sub $sub): SubViewData
    {
        $sub->load('workers');
        $remoteSub = $this->client->getSub(groupId: $sub->group_id);

        return $this->transform->transformSub($sub, $remoteSub->toArray());
    }

    public function getSubList(User $user): Collection
    {
        $remoteSubs = $this->client->getSubList();
        $localUserSubs = self::withLocal($user->pluck('id'), $remoteSubs->pluck('gid'));
        $transformed = $this->transformCollection($localUserSubs, $remoteSubs);

        return collect([
            'subs' => $transformed,
            'overall' => SubsOverallData::fromCollection(
                subs: $transformed,
                workers: $localUserSubs->pluck('workers')
            ),
        ]);
    }

    private function transformCollection(Collection $localSubs, Collection $remoteSubs): Collection
    {
        return $remoteSubs
            ->whereIn('gid', $localSubs->pluck('group_id'))
            ->map(function (array $remoteSub) use ($localSubs) {
                $targetSub = $localSubs
                    ->where('group_id', $remoteSub['gid'])
                    ->first();

                return $this->transform->transformSub(
                    sub: $targetSub,
                    remoteSub: $remoteSub
                );
            })->filter();
    }

    /**
     * Create remote sub-account
     * Create local sub-account based on remote sub-account group_id
     */
    public function create(
        User $user,
        string $subName,
    ): void {
        $remoteSub = $this->client->createRemoteSub(subName: $subName);

        Create::execute(
            subData: SubUpsertData::fromRequest([
                'user_id' => $user->id,
                'group_id' => $remoteSub['gid'],
                'sub_name' => $subName,
            ])
        );
    }

    public function createHash(): void
    {
        $remoteSubList = $this->client->getSubList();

        $localSubList = self::withLocal(User::pluck('id'), $remoteSubList->pluck('gid'));

        $transformed = $this->transformCollection($localSubList, $remoteSubList);

        $transformed->each(function (SubViewData $subData) {
            if ($subData->hashPerMinPure > 0) {

                // TODO: CreateNewAndDeleteOld action
                DeleteOldHashrates::execute(
                    groupId: $subData->groupId,
                    date: now()->subMonths(2)->toDateTimeString()
                );

                Hash::create([
                    'group_id' => $subData->groupId,
                    'hash' => $subData->hashPerMinPure,
                    'unit' => $subData->hashPerMinUnit,
                    'worker_count' => $subData->activeWorkersCount,
                ]);
            }
        });
    }
}
