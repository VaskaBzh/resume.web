<?php

namespace App\Enums\Worker;

enum Status
{
    case ACTIVE;
    case INACTIVE;
    case DEAD;

    public function status(): string
    {
        return match ($this) {
            Status::ACTIVE => 'ACTIVE',
            Status::INACTIVE => 'INACTIVE',
            Status::DEAD => 'DEAD',
        };
    }
}
