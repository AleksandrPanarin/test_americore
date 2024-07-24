<?php

declare(strict_types=1);

namespace App\Domain\Client;

use App\Domain\Client\Enums\State;
use App\Infrastructure\Doctrine\Type\StateEnumType;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

#[Embeddable]
final class Address
{
    #[ORM\Column(length: 255, nullable: false)]
    public string $city;

    #[ORM\Column(type: StateEnumType::STATE_TYPE, nullable: false)]
    public State $state;

    #[ORM\Column(length: 255, nullable: false)]
    public string $zipCode;

    public function __construct(string $city, string $state, string $zipCode)
    {
        if (State::tryFrom($state) === null) {
            throw new InvalidArgumentException('Invalid state.');
        }

        $this->city = $city;
        $this->state = State::from($state);
        $this->zipCode = $zipCode;
    }

    public function toString(): string
    {
        return $this->city . ', ' . $this->state->value . ' ' . $this->zipCode;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function state(): State
    {
        return $this->state;
    }
}