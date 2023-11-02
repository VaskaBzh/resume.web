<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\Sub\Create;
use App\Actions\User\AttachReferral;
use App\Dto\SubData;
use App\Enums\User\Roles;
use App\Events\Registered;
use App\Events\SubCreatedEvent;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Events\Dispatcher;

readonly class SubCreatingSubscriber
{
    public function __construct(private BtcComService $btcComService)
    {
    }

    /**
     * Create remote sub-account
     * Create local sub-account based on remote sub-account group_id
     * Attach referral program on created local sub-account if referral_code
     * Assign referral role to registered user if referral_code
     *
     * @param Registered $event
     * @return void
     */
    public function handleRegistered(Registered $event): void
    {
        //$remoteSub = $this->btcComService->createRemoteSub(subName: $event->user->name);

        Create::execute(
            subData: SubData::fromRequest([
                'user_id' => $event->user->id,
                'group_id' => 8888888,
                'group_name' => $event->user->name,
            ])
        );

        if (!$event->user->hasRole(Roles::REFERRAL->value) && $event->referralCode) {

            AttachReferral::execute(
                referrer: ReferralService::getReferrer($event->referralCode),
                referral: $event->user,
            );

            $event->user->assignRole(Roles::REFERRAL->value);
        }
    }

    /**
     * Create remote sub-account
     * Create local sub-account based on remote sub-account group_id
     * Attach referral program on created local sub-account if referral_code
     * Update referral_percent & discount if user has referrer role
     *
     * @param SubCreatedEvent $event
     * @return void
     */
    public function handleSubCreated(SubCreatedEvent $event): void
    {
       // $remoteSub = $this->btcComService->createRemoteSub(subName: $event->subName);

        Create::execute(
            subData: SubData::fromRequest([
                'user_id' => $event->user->id,
                'group_id' => 9999999,
                'group_name' => $event->user->name,
            ])
        );
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            Registered::class,
            [SubCreatingSubscriber::class, 'handleRegistered']
        );

        $events->listen(
            SubCreatedEvent::class,
            [SubCreatingSubscriber::class, 'handleSubCreated']
        );
    }
}
