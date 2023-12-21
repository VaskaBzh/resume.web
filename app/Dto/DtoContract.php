<?php

declare(strict_types=1);

namespace App\Dto;

interface DtoContract
{
    public static function fromArray(array $data): self;
}
