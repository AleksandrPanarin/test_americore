<?php

declare(strict_types=1);

namespace App\Domain\Loan;

interface LoanRepositoryInterface
{
    public function add(Loan $loan): void;

    public function update(Loan $loan): void;
}
