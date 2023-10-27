<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends BaseBuilder
{
    public function getOwner(int $userId): Builder
    {
        return $this->find($userId);
    }
}
