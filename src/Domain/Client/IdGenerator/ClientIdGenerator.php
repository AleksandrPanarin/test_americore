<?php

declare(strict_types=1);

namespace App\Domain\Client\IdGenerator;

use App\Domain\Client\ClientId;

final class ClientIdGenerator implements ClientIdGeneratorInterface
{
    public function nextId(): ClientId
    {
        return ClientId::create();
    }
}