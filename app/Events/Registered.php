<?php

declare(strict_types=1);

namespace App\Events;

use \Illuminate\Auth\Events\Registered as BaseRegistered;
use Illuminate\Foundation\Events\Dispatchable;

class Registered extends BaseRegistered
{
    use Dispatchable;

    public function __construct(public $user, public ?string $referralCode)
    {
        parent::__construct($this->user);
    }
}
