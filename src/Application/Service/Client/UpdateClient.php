<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\Dto\ClientDto;
use App\Domain\Client\ClientId;

final class UpdateClient
{
    private readonly string $clientId;
    private readonly ClientDto $clientDto;

    public function __construct(string $clientId, ClientDto $clientDto)
    {
        $this->clientDto = $clientDto;
        $this->clientId = $clientId;
    }

    public function clientDto(): ClientDto
    {
        return $this->clientDto;
    }

    public function clientId(): ClientId
    {
        return ClientId::fromString($this->clientId);
    }
}