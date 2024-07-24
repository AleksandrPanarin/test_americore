<?php

declare(strict_types=1);

namespace App\Domain\Loan\IdGenerator;

use App\Domain\Loan\LoanId;

interface LoanIdGeneratorInterface
{
    public function nextId(): LoanId;
}