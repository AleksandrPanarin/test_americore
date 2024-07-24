<?php

declare(strict_types=1);

namespace App\Domain\Client;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

#[Embeddable]
final class Age
{
    private const  MIN_AGE = 18;
    private const  MAX_AGE = 60;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private int $age;

    public function __construct(int $age)
    {
        if ($age < self::MIN_AGE || $age > self::MAX_AGE) {
            throw new InvalidArgumentException('Age must be between 18 and 60');
        }

        $this->age = $age;
    }

    public function age(): int
    {
        return $this->age;
    }
}