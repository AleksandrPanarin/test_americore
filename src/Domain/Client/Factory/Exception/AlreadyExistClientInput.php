<?php

declare(strict_types=1);

namespace App\Domain\Client\Factory\Exception;

use App\Domain\Client\LoanIssueChecker\Ssn;
use RuntimeException;

final class AlreadyExistClientInput extends RuntimeException
{
    public static function withEmail(string $email): self
    {
        return new self(
            sprintf('Email address %s already exist.', $email)
        );
    }

    public static function withSsn(Ssn $ssn): self
    {
        return new self(
            sprintf('Ssn %s already exist.', $ssn->toString())
        );
    }
}
