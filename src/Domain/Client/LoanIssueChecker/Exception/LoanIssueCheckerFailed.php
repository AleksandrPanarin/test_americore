<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker\Exception;

use App\Domain\Client\Enums\State;
use RuntimeException;

final class LoanIssueCheckerFailed extends RuntimeException
{
    public static function dueToCreditScoreTooLow(int $creditScore): self
    {
        return new self(sprintf('Credit rating score is too low. Current score is %s', $creditScore));
    }

    public static function dueToIncomeTooLow(float $income): self
    {
        return new self(sprintf('Income is too low. Current income %s', $income));
    }

    public static function dueToInaccessibleAge(int $age): self
    {
        return new self(sprintf('Income is too low. Current age is %s', $age));
    }

    public static function dueToStateNotAllowed(State $state)
    {
        return new self(sprintf('State not allowed. Current state %s.', $state->value()));
    }

    public static function dueToRandowNotAllowed(State $state)
    {
        return new self(sprintf('State randow not allowed. Current state %s.', $state->value()));
    }
}