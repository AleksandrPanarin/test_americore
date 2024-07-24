<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Domain\Client\ClientId;

final class SendEmailNotification
{
    public function __construct(
        private readonly string $clientId
    ) {
    }

    public function clientId(): ClientId
    {
        return ClientId::fromString($this->clientId);
    }
}