<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Arr;

final readonly class FilterData
{
    public function __construct(
        public ?bool $hasTxId,
        public ?int $perPage,
    ) {
    }

    public static function fromRequest(array $requestData): FilterData
    {
        return new self(
            hasTxId: Arr::get($requestData, 'filter.txid'),
            perPage: Arr::get($requestData, 'per_page', 15)
        );
    }
}
