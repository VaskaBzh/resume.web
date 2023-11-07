<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\User\AttachReferral;
use App\Enums\User\Roles;
use App\Events\Registered;
use App\Services\External\BtcComService;
use App\Services\Internal\ReferralService;

final readonly class SubCreatingListener
{
    /**
     * Create remote sub-account
     * Create local sub-account based on remote sub-account group_id
     * Attach referral program on user if referral_code exists
     * Assign referral role to registered user if referral_code exists
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        if (!$event->user->hasRole(Roles::REFERRAL->value) && $event->referralCode) {

            AttachReferral::execute(
                referrer: ReferralService::getReferrer($event->referralCode),
                referral: $event->user,
            );

            $event->user->assignRole(Roles::REFERRAL->value);
        }

        app(BtcComService::class)->createLocalSub(
            user: $event->user,
            subName: $event->user->name
        );
    }
}
