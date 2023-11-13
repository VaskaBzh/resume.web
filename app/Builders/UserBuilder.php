<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuilder extends BaseBuilder
{
    public function active(): HasMany
    {
        return $this->model->subs()->main();
    }
}
