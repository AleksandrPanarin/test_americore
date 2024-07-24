<?php

declare(strict_types=1);

namespace App\Domain\Client\ClientChanger;

use App\Domain\Client\Address;
use App\Domain\Client\Age;
use App\Domain\Client\Client;
use App\Domain\Client\ClientContacts;
use App\Domain\Client\ClientFinancialDetails;
use App\Domain\Client\FullName;
use App\Domain\Client\LoanIssueChecker\Ssn;

final class ChangeClientInput
{
    public function __construct(
        private Client $client,
        private readonly FullName $fullName,
        private readonly Age $age,
        private readonly Address $address,
        private readonly Ssn $ssn,
        private readonly ClientContacts $clientContacts,
        private readonly ClientFinancialDetails $financialDetails
    ) {
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function fullName(): FullName
    {
        return $this->fullName;
    }

    public function age(): Age
    {
        return $this->age;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function ssn(): Ssn
    {
        return $this->ssn;
    }

    public function clientContacts(): ClientContacts
    {
        return $this->clientContacts;
    }

    public function financialDetails(): ClientFinancialDetails
    {
        return $this->financialDetails;
    }
}