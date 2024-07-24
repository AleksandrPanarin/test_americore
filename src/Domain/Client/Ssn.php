<?php

declare(strict_types=1);

namespace App\Domain\Client;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping as ORM;

#[Embeddable]
final class Ssn
{
    #[ORM\Column(length: 255, nullable: false)]
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function equals(Ssn $ssn): bool
    {
        return $this->value === $ssn->value;
    }
}