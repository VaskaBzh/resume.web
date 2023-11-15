<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuilder extends BaseBuilder
{
    public function activeSub(): HasMany
    {
        return $this->model
            ->subs()
            ->where('group_id', $this->model->active_sub);
    }
}
