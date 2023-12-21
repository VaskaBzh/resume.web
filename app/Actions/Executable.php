<?php

declare(strict_types=1);

namespace App\Actions;

use App\Dto\DtoContract;

interface Executable
{
    public static function execute(DtoContract $data);
}
