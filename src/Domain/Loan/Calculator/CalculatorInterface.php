<?php

declare(strict_types=1);

namespace App\Domain\Loan\Calculator;

interface CalculatorInterface
{
    public function calculate(CalculatorInput $input):CalculatorResult;
}
