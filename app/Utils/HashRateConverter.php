<?php

declare(strict_types=1);

namespace App\Utils;

use App\Enums\Hash\Unit;

final readonly class HashRateConverter
{
    private function __construct(
        public string $value,
        public string $unit
    ) {

    }

    /**
     * Convert pure hash rate
     */
    public static function fromPure(int $pureHashRate): HashRateConverter
    {
        $numberLength = strlen((string) $pureHashRate);
        $gH = $pureHashRate / pow(10, 9);

        return match (true) {
            $pureHashRate == 0 || $numberLength < 10 => new self(
                '0.0',
                Unit::TERA_HASH->value
            ),
            $pureHashRate > 0 && $numberLength < 13 => new self(
                number_format($gH, 2, '.', ''),
                Unit::GIGA_HASH->value
            ),
            $numberLength < 16 && $numberLength >= 13 => new self(
                number_format($gH / 1000, 2, '.', ''),
                Unit::TERA_HASH->value
            ),
            $numberLength >= 16 => new self(
                number_format($gH / 1000000, 2, '.', ''),
                Unit::PETA_HASH->value
            ),
            default => throw new \Exception('Number can not be unsigned')
        };
    }

    /**
     * Convert to pure hash rate
     */
    public static function toPure(float $value, Unit $unit): HashRateConverter
    {
        $pure = match ($unit) {
            Unit::GIGA_HASH => $value * pow(10, 9),
            Unit::TERA_HASH => $value * pow(10, 12),
            Unit::PETA_HASH => $value * pow(10, 15),
            default => throw new \Exception('Number can not be unsigned')
        };

        return new self(number_format($pure, 0, '.', ''), 'pure');
    }
}
