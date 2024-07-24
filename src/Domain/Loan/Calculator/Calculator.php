<?php

declare(strict_types=1);

namespace App\Domain\Loan\Calculator;

final class Calculator implements CalculatorInterface
{
    private const int DAY_IN_YEAR = 365;

    public function calculate(CalculatorInput $input): CalculatorResult
    {
        $convertToPercent = $input->interestRate()->div(100);

        $interestInDay = $input->amount()
            ->mul($convertToPercent)
            ->div(self::DAY_IN_YEAR);

        $totalInterest = $input->amount()
            ->mul($convertToPercent)
            ->div(self::DAY_IN_YEAR)
            ->mul($input->loanTerm());

        $totalAmount = $totalInterest->add($input->amount());

        return new CalculatorResult(
            $totalAmount,
            $interestInDay,
            $totalInterest
        );
    }

}