<?php

declare(strict_types=1);

namespace App\Domain\Client;

use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

#[Embeddable]
final class FullName
{
    #[ORM\Column(length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(length: 255, nullable: false)]
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException('First name cannot be empty');
        }

        if (empty($lastName)) {
            throw new InvalidArgumentException('Last name cannot be empty');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}