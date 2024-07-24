<?php

declare(strict_types=1);

namespace App\Application\Service\Loan\Exception;

use RuntimeException;
use Throwable;

final class LoanIssueFailed extends RuntimeException
{
    public static function dueToIncorrectDataPassed(Throwable $e): self
    {
        return new self($e->getMessage(), 0, $e);
    }
}