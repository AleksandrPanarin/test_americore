<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory;

use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Factory\Exception\AlreadyExistClientInput;

final class ValidatingClientFactory implements ClientFactoryInterface
{
    public function __construct(
        private readonly ClientFactoryInterface $decorated,
        private readonly ClientRepositoryInterface $clients
    ) {
    }

    public function create(ClientInput $input): ClientResult
    {
        if ($this->clients->hasEmail($input->email())) {
            throw AlreadyExistClientInput::withEmail($input->email());
        }

        if ($this->clients->hasSsn($input->ssn())) {
            throw AlreadyExistClientInput::withSsn($input->ssn());
        }

        return $this->decorated->create($input);
    }
}