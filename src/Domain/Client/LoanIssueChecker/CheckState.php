<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;

final class CheckState implements LoanIssueCheckerInterface
{
    public function check(LoanIssueCheckClientInput $input): void
    {
        $state = $input->address()->state();
        if (! $state->isCalifornia() && ! $state->isNewYork() && ! $state->isNevada()) {
            throw LoanIssueCheckerFailed::dueToStateNotAllowed($state);
        }

        if ($state->isNewYork() && rand(0, 1) === 1) {
            throw LoanIssueCheckerFailed::dueToRandowNotAllowed($state);
        }
    }
}