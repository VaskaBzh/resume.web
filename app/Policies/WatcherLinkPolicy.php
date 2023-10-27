<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WatcherLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatcherLinkPolicy
{
    use HandlesAuthorization;

    public function viewOrChange(User $user, WatcherLink $watcher): bool
    {
        return $user->id === $watcher->user_id;
    }
}
