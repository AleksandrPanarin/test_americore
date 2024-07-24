<?php

declare(strict_types=1);

namespace App\Domain\Loan\Factory;

use App\Domain\Loan\LoanType;
use Decimal\Decimal;

final class LoanInput
{
    public function __construct(
        private readonly string $clientId,
        private readonly LoanType $loanType,
        private readonly int $loanTerm,
        private readonly Decimal $interestRate,
        private readonly Decimal $amount
    ) {
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function loanType(): LoanType
    {
        return $this->loanType;
    }

    public function loanTerm(): int
    {
        return $this->loanTerm;
    }

    public function interestRate(): Decimal
    {
        return $this->interestRate;
    }

    public function amount(): Decimal
    {
        return $this->amount;
    }

}