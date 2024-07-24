<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;

final class CheckIncome implements LoanIssueCheckerInterface
{
    private const int MIN_INCOME = 1000;

    public function check(LoanIssueCheckClientInput $input): void
    {
        if ($input->income() < self::MIN_INCOME) {
            throw LoanIssueCheckerFailed::dueToIncomeTooLow($input->income());
        }
    }
}