<?php

declare(strict_types=1);

namespace App\Domain\Client\Exception;

use App\Domain\Client\ClientId;
use DomainException;

final class ClientNotFound extends DomainException
{
    public static function byUuid(ClientId $id): self
    {
        return new self(sprintf('Client by uuid "%s" not found.', $id));
    }
}