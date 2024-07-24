<?php

declare(strict_types=1);

namespace App\Domain\Loan\InterestRateProvider;

use App\Domain\Loan\LoanType;
use Decimal\Decimal;

final class InterestRateProvider implements InterestRateProviderInterface
{
    private const STANDARD_CREDIT_PERCENT = '6';
    private const AUTO_CREDIT_PERCENT = '8';

    public function provide(InterestRateInput $input): Decimal
    {
        return match ($input->loanType()) {
            LoanType::STANDARD_CREDIT => new Decimal(self::STANDARD_CREDIT_PERCENT),
            LoanType::AUTO_CREDIT => new Decimal(self::AUTO_CREDIT_PERCENT),
        };
    }
}