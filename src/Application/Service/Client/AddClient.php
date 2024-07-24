<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\Dto\ClientDto;
use App\Domain\Client\Address;
use App\Domain\Client\Age;
use App\Domain\Client\ClientContacts;
use App\Domain\Client\ClientFinancialDetails;
use App\Domain\Client\Factory\ClientInput;
use App\Domain\Client\FullName;
use App\Domain\Client\Ssn;
use Decimal\Decimal;

final class AddClient
{
    private readonly ClientDto $clientDto;

    public function __construct(ClientDto $clientDto)
    {
        $this->clientDto = $clientDto;
    }

    public function clientInput(): ClientInput
    {
        return new ClientInput(
            new FullName($this->clientDto->firstName, $this->clientDto->lastName),
            new Age($this->clientDto->age),
            new Address($this->clientDto->city, $this->clientDto->state, $this->clientDto->zipCode),
            new Ssn($this->clientDto->ssn),
            new ClientContacts($this->clientDto->email, $this->clientDto->phone),
            new ClientFinancialDetails(
                $this->clientDto->creditScore,
                new Decimal((string) $this->clientDto->income)
            )
        );
    }

    public function clientDto(): ClientDto
    {
        return $this->clientDto;
    }
}