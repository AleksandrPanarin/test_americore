<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory;

interface LoanFactoryInterface
{
    public function create(LoanInput $input): LoanResult;
}