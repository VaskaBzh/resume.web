<?php

namespace App\Policies;

use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    public function viewOrChange(User $user, Wallet $wallet): bool
    {
        return in_array($wallet->group_id, $user->subs()->pluck('group_id')->toArray(), true);
    }
}
