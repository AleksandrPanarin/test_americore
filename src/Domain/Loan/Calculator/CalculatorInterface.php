<?php

declare(strict_types=1);

namespace App\Domain\Loan\Calculator;

use Decimal\Decimal;

interface CalculatorInterface
{
    public function calculate(CalculatorInput $input):CalculatorResult;
}
