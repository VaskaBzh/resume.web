<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Enums\Hash\Unit;

class HashRate
{
    public float $value;

    public string $unit;

    private function __construct(float $value)
    {
        if ($value < 0) {
            throw new \Exception('Number can not be unsigned');
        }

        match (true) {
            $value < 1 => $this->set($value * 1000, Unit::GIGA_HASH->value),
            $value >= 1000 && $value < 100000 => $this->set($value / 1000, Unit::PETA_HASH->value),
            default => $this->set($value, Unit::TERA_HASH->value)
        };

        $this->value = (float) number_format($this->value, 2);
    }

    private function set($value, $unit): void
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function from(?float $value): HashRate
    {
        return new self($value);
    }
}
