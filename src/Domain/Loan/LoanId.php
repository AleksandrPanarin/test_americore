<?php

declare(strict_types=1);

namespace App\Domain\Loan;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class LoanId
{
    private string $id;

    private function __construct(string $id)
    {
        if(!Uuid::isValid($id)){
            throw new InvalidArgumentException('Invalid UUID provided.');
        }

        $this->id = $id;
    }

    public static function create(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public static function fromString(string $id): LoanId
    {
        return new self($id);
    }


    public function toString(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}