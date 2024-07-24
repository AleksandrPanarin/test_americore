<?php

declare(strict_types=1);

namespace App\Application\Service\Client\Exception;

use RuntimeException;
use Throwable;

final class ClientCreatingFailed extends RuntimeException
{
    public static function dueToIncorrectDataPassed(Throwable $e): self
    {
        return new self($e->getMessage(), 0, $e);
    }
}