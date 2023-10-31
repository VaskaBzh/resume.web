<?php

declare(strict_types=1);

namespace App\Exceptions;

class BusinessException extends \RuntimeException
{
    public function __construct(
        private readonly string $clientMessage,
        private readonly int $statusCode,
    )
    {
        parent::__construct($this->clientMessage);
    }

    public function getClientMessage(): string
    {
        return $this->clientMessage;
    }

    public function getClientStatusCode(): int
    {
        return $this->statusCode;
    }
}
