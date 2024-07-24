<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory;

interface ClientFactoryInterface
{
    public function create(ClientInput $input): ClientResult;
}