<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuilder extends BaseBuilder
{
    public function active(): HasMany
    {
        return $this->model->subs()->main();
    }
}
