<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Domain\Client\ClientId;

final class CheckLoanIssue
{
    private readonly string $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function clientId(): ClientId
    {
        return ClientId::fromString($this->clientId);
    }
}