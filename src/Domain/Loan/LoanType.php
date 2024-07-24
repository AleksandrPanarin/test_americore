<?php

declare(strict_types=1);

namespace App\Domain\Loan;

enum LoanType: string
{
    case STANDARD_CREDIT = 'standard_credit';
    case AUTO_CREDIT = 'auto_credit';

    public static function values(): array
    {
        return [
            self::STANDARD_CREDIT,
            self::AUTO_CREDIT,
        ];
    }

    public function value(): string
    {
        return $this->value;
    }
}