<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Sub;
use Illuminate\Foundation\Events\Dispatchable;

class PayOutEvent
{
    use Dispatchable;

    public function __construct(public readonly Sub $sub)
    {
    }
}
