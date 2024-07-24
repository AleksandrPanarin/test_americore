<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;

final class CheckCreditRating implements LoanIssueCheckerInterface
{
    private const int MIN_CREDIT_SCORE = 300;

    public function check(LoanIssueCheckClientInput $input): void
    {
        if ($input->creditScore() < self::MIN_CREDIT_SCORE) {
            throw LoanIssueCheckerFailed::dueToCreditScoreTooLow($input->creditScore());
        }
    }
}