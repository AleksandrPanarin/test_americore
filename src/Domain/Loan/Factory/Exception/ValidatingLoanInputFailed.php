<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory\Exception;

use Decimal\Decimal;
use RuntimeException;

final class ValidatingLoanInputFailed extends RuntimeException
{
    public static function withTerm(int $term): self
    {
        return new self(
            sprintf('Term must be greater than 1. Current term %s.', $term)
        );
    }

    public static function withInterestRate(Decimal $interestRate): self
    {
        return new self(
            sprintf('Interest rate must be greater than 0. Current interest rate %s.', $interestRate->toString())
        );
    }

    public static function withAmount(Decimal $amount): self
    {
        return new self(
            sprintf('Amount must be greater than 0. Current amount %s.', $amount->toString())
        );
    }
}
