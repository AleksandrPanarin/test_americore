<?php

declare(strict_types=1);

namespace App\Domain\Loan\Calculator;

use Decimal\Decimal;

final class CalculatorInput
{
    public function __construct(
        private readonly Decimal $amount,
        private readonly int $loanTerm,
        private readonly Decimal $interestRate
    ) {
    }

    public function amount(): Decimal
    {
        return $this->amount;
    }

    public function loanTerm(): int
    {
        return $this->loanTerm;
    }

    public function interestRate(): Decimal
    {
        return $this->interestRate;
    }
}