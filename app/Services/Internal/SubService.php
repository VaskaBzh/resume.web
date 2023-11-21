<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Sub\Create;
use App\Dto\Sub\SubsOverallData;
use App\Dto\Sub\SubUpsertData;
use App\Dto\Sub\SubViewData;
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

    public function getSub(Sub $sub): SubViewData
    {
        $sub->load('workers');
        $remoteSub = $this->client->getSub(groupId: $sub->group_id);

        return $this->transform->transformSub($sub, $remoteSub->toArray());
    }

    public function getSubList(User $user): Collection
    {
        $remoteSubs = $this->client->getSubList();

        $localUserSubs = $user->subs()
            ->whereIn('group_id', $remoteSubs->pluck('gid'))
            ->with(['workers'])
            ->get();

        $transformed = $remoteSubs
            ->whereIn('gid', $localUserSubs->pluck('group_id'))
            ->map(function (array $remoteSub) use ($localUserSubs) {
                $targetSub = $localUserSubs
                    ->where('group_id', $remoteSub['gid'])
                    ->first();

                return $this->transform->transformSub(
                    sub: $targetSub,
                    remoteSub: $remoteSub
                );

            })->filter();

        return collect([
            'subs' => $transformed,
            'overall' => SubsOverallData::fromCollection(
                subs: $transformed,
                workers: $localUserSubs->pluck('workers')
            ),
        ]);
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
}
