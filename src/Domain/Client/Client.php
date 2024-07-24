<?php

namespace App\Domain\Client;

use App\Domain\Client\Enums\State;
use App\Infrastructure\Doctrine\Repository\OrmClientRepository;
use App\Infrastructure\Doctrine\Type\ClientIdType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;

#[ORM\Entity(repositoryClass: OrmClientRepository::class)]
#[ORM\Table(name: 'clients')]
final class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $incrementalId = null;

    #[ORM\Column(type: ClientIdType::CLIENT_ID, nullable: false)]
    private ClientId $id;

    #[Embedded(class: FullName::class)]
    private FullName $fullName;

    #[Embedded(class: Age::class)]
    private Age $age;

    #[Embedded(class: Address::class)]
    private Address $address;

    #[Embedded(class: Ssn::class)]
    private Ssn $ssn;

    #[Embedded(class: ClientContacts::class)]
    private ClientContacts $contacts;

    #[Embedded(class: ClientFinancialDetails::class)]
    private ClientFinancialDetails $financialDetails;

    public function __construct(
        ClientId $id,
        FullName $fullName,
        Age $age,
        Address $address,
        Ssn $ssn,
        ClientContacts $contacts,
        ClientFinancialDetails $financialDetails
    ) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->age = $age;
        $this->address = $address;
        $this->ssn = $ssn;
        $this->contacts = $contacts;
        $this->financialDetails = $financialDetails;
    }

    public function changed(
        FullName $fullName,
        Age $age,
        Address $address,
        Ssn $ssn,
        ClientContacts $contacts,
        ClientFinancialDetails $financialDetails
    ): void {
        $this->fullName = $fullName;
        $this->age = $age;
        $this->address = $address;
        $this->ssn = $ssn;
        $this->contacts = $contacts;
        $this->financialDetails = $financialDetails;
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

    public function state(): State
    {
        return $this->address->state();
    }

    public function financialDetails(): ClientFinancialDetails
    {
        return $this->financialDetails;
    }

    public function email(): string
    {
        return $this->contacts->email();
    }
}