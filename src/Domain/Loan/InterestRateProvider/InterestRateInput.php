<?php

declare(strict_types=1);

namespace App\Domain\Loan\InterestRateProvider;

use App\Domain\Client\ClientId;
use App\Domain\Loan\LoanType;

final class InterestRateInput
{
    public function __construct(
        private readonly ClientId $clientId,
        private readonly LoanType $loanType
    ) {
    }

    public function clientId(): ClientId
    {
        return $this->clientId;
    }

    public function loanType(): LoanType
    {
        return $this->loanType;
    }
}