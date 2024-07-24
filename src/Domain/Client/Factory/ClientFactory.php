<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory;

use App\Domain\Client\Client;
use App\Domain\Client\IdGenerator\ClientIdGeneratorInterface;

final class ClientFactory implements ClientFactoryInterface
{
    public function __construct(
        private readonly ClientIdGeneratorInterface $clientIdGenerator
    ) {
    }

    public function create(ClientInput $input): ClientResult
    {
        $client = new Client(
            $this->clientIdGenerator->nextId(),
            $input->fullName(),
            $input->age(),
            $input->address(),
            $input->ssn(),
            $input->contacts(),
            $input->financialDetails()
        );

        return new ClientResult($client);
    }
}