<?php

declare(strict_types=1);

namespace App\Application\Service\Loan;

use App\Domain\Client\ClientId;
use App\Domain\Loan\LoanType;
use Decimal\Decimal;
use InvalidArgumentException;

final class IssueLoan
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $loanType,
        private readonly int $loanTerm,
        private readonly string $amount
    ) {
    }

    public function clientId(): ClientId
    {
        return ClientId::fromString($this->clientId);
    }

    public function loanType(): LoanType
    {
        if (LoanType::tryFrom($this->loanType) === null) {
            throw new InvalidArgumentException('Invalid loan type.');
        }

        return LoanType::from($this->loanType);
    }

    public function loanTerm(): int
    {
        return $this->loanTerm;
    }

    public function amount(): Decimal
    {
        return new Decimal($this->amount);
    }

}