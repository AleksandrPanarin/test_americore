<?php

declare(strict_types=1);

namespace App\Domain\Loan\Calculator;

use Decimal\Decimal;

final class CalculatorResult
{
    public function __construct(
        private readonly Decimal $totalAmount,
        private readonly Decimal $interestInDay,
        private readonly Decimal $totalInterest,
    )
    {
    }

    public function totalAmount(): Decimal
    {
        return $this->totalAmount;
    }

    public function interestInDay(): Decimal
    {
        return $this->interestInDay;
    }

    public function totalInterest(): Decimal
    {
        return $this->totalInterest;
    }
}