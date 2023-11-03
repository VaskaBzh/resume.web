<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\User\AttachReferral;
use App\Enums\User\Roles;
use App\Events\Registered;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;
use Illuminate\Events\Dispatcher;

readonly class SubCreatingSubscriber
{
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
        app(BtcComService::class)->createLocalSub(
            user: $event->user,
            subName: $event->user->name
        );

        if (!$event->user->hasRole(Roles::REFERRAL->value) && $event->referralCode) {

            AttachReferral::execute(
                referrer: ReferralService::getReferrer($event->referralCode),
                referral: $event->user,
            );

            $event->user->assignRole(Roles::REFERRAL->value);
        }
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            Registered::class,
            [SubCreatingSubscriber::class, 'handleRegistered']
        );
    }
}
