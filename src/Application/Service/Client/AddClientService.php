<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\Service\Client\Exception\ClientCreatingFailed;
use App\Application\UseCase\AddClientUseCase;
use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Factory\ClientFactoryInterface;
use App\Domain\Client\Factory\Exception\AlreadyExistClientInput;
use Psr\Log\InvalidArgumentException;

final class AddClientService implements AddClientUseCase
{
    public function __construct(
        private readonly ClientRepositoryInterface $clients,
        private readonly ClientFactoryInterface $factory,
    ) {
    }

    public function execute(AddClient $command): void
    {
        try {
            $result = $this->factory->create($command->clientInput());

            $this->clients->add($result->client());
        } catch (AlreadyExistClientInput|InvalidArgumentException $e) {
            throw ClientCreatingFailed::dueToIncorrectDataPassed($e);
        }
    }
}