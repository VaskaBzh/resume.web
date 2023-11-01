<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Sub;

class AttachReferral
{
    public static function execute(Sub $referrerSub, Sub $referralSub): void
    {
        $referralSub->update(['referrer_id' => $referrerSub->group_id]);
    }
}
