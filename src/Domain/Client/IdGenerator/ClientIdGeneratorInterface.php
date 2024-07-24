<?php

declare(strict_types=1);

namespace App\Domain\Client\IdGenerator;

use App\Domain\Client\ClientId;

interface ClientIdGeneratorInterface
{
    public function nextId(): ClientId;
}