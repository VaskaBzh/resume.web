<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubPolicy
{
    use HandlesAuthorization;

    public function viewOrChange(User $user, Sub $sub): bool
    {
        return $user->id === $sub->user_id;
    }

    public function viewAny(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    public function activate(User $user): bool
    {
        return $user->hasRole('referrer');
    }
}
