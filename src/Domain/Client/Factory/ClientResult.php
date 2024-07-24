<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory;

use App\Domain\Client\Client;

final class ClientResult
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function client(): Client
    {
        return $this->client;
    }
}