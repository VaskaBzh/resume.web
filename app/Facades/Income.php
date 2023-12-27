<?php

declare(strict_types=1);

namespace App\Facades;

use App\Dto\Income\UpdateStatusData;
use App\Models\Sub;
use Illuminate\Support\Facades\Facade;

/**
 * @method localSubProcess(Sub $sub)
 * @method updateIncomes(UpdateStatusData $updateStatusData)
 * @method createFinance()
 */
class Income extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'income';
    }
}
