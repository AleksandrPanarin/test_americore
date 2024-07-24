<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;

final class CheckAge implements LoanIssueCheckerInterface
{
    private const int MIN_AGE = 18;
    private const int MAX_AGE = 60;

    public function check(LoanIssueCheckClientInput $input): void
    {
        if ($input->age() < self::MIN_AGE || $input->age() > self::MAX_AGE) {
            throw LoanIssueCheckerFailed::dueToInaccessibleAge($input->age());
        }
    }
}