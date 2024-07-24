<?php

declare(strict_types=1);

namespace App\Domain\Loan\IdGenerator;

use App\Domain\Loan\LoanId;

final class LoanIdGenerator implements LoanIdGeneratorInterface
{
    public function nextId(): LoanId
    {
        return LoanId::create();
    }
}