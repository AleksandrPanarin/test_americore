<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;

interface LoanIssueCheckerInterface
{
    /**
     * @throws LoanIssueCheckerFailed
     */
    public function check(LoanIssueCheckClientInput $input): void;
}