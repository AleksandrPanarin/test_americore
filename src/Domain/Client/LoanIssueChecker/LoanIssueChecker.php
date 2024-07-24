<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

final class LoanIssueChecker implements LoanIssueCheckerInterface
{
    public function __construct(
        /** @var iterable<LoanIssueCheckerInterface> */
        private readonly iterable $checkers
    ) {
    }

    public function check(LoanIssueCheckClientInput $input): void
    {
        foreach ($this->checkers as $checker) {
            $checker->check($input);
        }
    }
}