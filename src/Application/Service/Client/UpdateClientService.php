<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\Service\Client\Exception\UpdateClientFailed;
use App\Application\UseCase\UpdateClientUseCase;
use App\Domain\Client\Address;
use App\Domain\Client\Age;
use App\Domain\Client\ClientChanger\ChangeClientInput;
use App\Domain\Client\ClientChanger\ClientChangerInterface;
use App\Domain\Client\ClientContacts;
use App\Domain\Client\ClientFinancialDetails;
use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Exception\ClientNotFound;
use App\Domain\Client\Factory\Exception\AlreadyExistClientInput;
use App\Domain\Client\FullName;
use App\Domain\Client\Ssn;
use Decimal\Decimal;
use Psr\Log\InvalidArgumentException;

final class UpdateClientService implements UpdateClientUseCase
{
    public function __construct(
        private readonly ClientChangerInterface $clientChanger,
        private readonly ClientRepositoryInterface $clients,
    ) {
    }

    public function execute(UpdateClient $command): void
    {
        try {
            $client = $this->clients->getById($command->clientId());

            $dto = $command->clientDto();

            $this->clientChanger->changeClientData(
                new ChangeClientInput(
                    $client,
                    new FullName($dto->firstName, $dto->lastName),
                    new Age($dto->age),
                    new Address($dto->city, $dto->state, $dto->zipCode),
                    new Ssn($dto->ssn),
                    new ClientContacts($dto->email, $dto->phone),
                    new ClientFinancialDetails($dto->creditScore, new Decimal((string)$dto->income)),
                )
            );

            $this->clients->update($client);
        } catch (AlreadyExistClientInput|InvalidArgumentException|ClientNotFound $e) {
            throw UpdateClientFailed::dueToIncorrectDataPassed($e);
        }
    }
}