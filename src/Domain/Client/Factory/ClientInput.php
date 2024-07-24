<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory;

use App\Domain\Client\Address;
use App\Domain\Client\Age;
use App\Domain\Client\ClientContacts;
use App\Domain\Client\ClientFinancialDetails;
use App\Domain\Client\FullName;
use App\Domain\Client\Ssn;

final class ClientInput
{
    public function __construct(
        private readonly FullName $fullName,
        private readonly Age $age,
        private readonly Address $address,
        private readonly Ssn $ssn,
        private readonly ClientContacts $contacts,
        private readonly ClientFinancialDetails $financialDetails,
    ) {
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

    public function financialDetails(): ClientFinancialDetails
    {
        return $this->financialDetails;
    }

    public function email(): string
    {
        return $this->contacts->email();
    }

    public function contacts(): ClientContacts
    {
        return $this->contacts;
    }
}