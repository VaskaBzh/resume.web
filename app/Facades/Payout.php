<?php

declare(strict_types=1);

namespace App\Facades;

use App\Models\Sub;
use Illuminate\Support\Facades\Facade;

/**
 * @method localSubProcess(Sub $sub)
 */
class Payout extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'payout';
    }
}
