<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory;

use App\Domain\Loan\Loan;

final class LoanResult
{
    private Loan $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function loan(): Loan
    {
        return $this->loan;
    }
}