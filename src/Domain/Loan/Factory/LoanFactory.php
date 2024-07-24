<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory;

use App\Domain\Loan\IdGenerator\LoanIdGeneratorInterface;
use App\Domain\Loan\Calculator\CalculatorInput;
use App\Domain\Loan\Calculator\CalculatorInterface;
use App\Domain\Loan\Loan;

final class LoanFactory implements LoanFactoryInterface
{
    public function __construct(
        private readonly LoanIdGeneratorInterface $loanIdGenerator,
        private readonly CalculatorInterface $calculator
    ) {
    }

    public function create(LoanInput $input): LoanResult
    {
        $calculateResult = $this->calculator->calculate(
            new CalculatorInput($input->amount(), $input->loanTerm(), $input->interestRate())
        );

        $loan = new Loan(
            $this->loanIdGenerator->nextId(),
            $input->clientId(),
            $input->loanType(),
            $input->loanTerm(),
            $input->interestRate(),
            $input->amount(),
            $calculateResult->totalAmount()
        );

        return new LoanResult($loan);
    }
}