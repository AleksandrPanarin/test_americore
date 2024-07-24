<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory;

use App\Domain\Loan\Factory\Exception\ValidatingLoanInputFailed;

final class ValidatingLoanFactory implements LoanFactoryInterface
{
    public function __construct(
        private readonly LoanFactoryInterface $decorated,
    ) {
    }

    public function create(LoanInput $input): LoanResult
    {
        if ($input->loanTerm() <= 1) {
            throw ValidatingLoanInputFailed::withTerm($input->loanTerm());
        }

        if (!$input->interestRate()->isPositive() || $input->interestRate()->isZero()){
            throw ValidatingLoanInputFailed::withInterestRate($input->interestRate());
        }

        if (!$input->amount()->isPositive() || $input->amount()->isZero()){
            throw ValidatingLoanInputFailed::withAmount($input->interestRate());
        }

        return $this->decorated->create($input);
    }
}