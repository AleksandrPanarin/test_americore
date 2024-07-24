<?php

declare(strict_types=1);

namespace App\Domain\Client\LoanIssueChecker;

use App\Domain\Client\Address;
use App\Domain\Client\Age;
use App\Domain\Client\ClientFinancialDetails;
use App\Domain\Client\Ssn;
use Decimal\Decimal;

final class LoanIssueCheckClientInput
{
    public function __construct(
        private readonly Age $age,
        private readonly Address $address,
        private readonly Ssn $ssn,
        private readonly ClientFinancialDetails $financialDetails
    ) {
    }

    public function age(): int
    {
        return $this->age->age();
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function ssn(): Ssn
    {
        return $this->ssn;
    }

    public function creditScore(): int
    {
        return $this->financialDetails->creditScore();
    }

    public function income(): float
    {
        return $this->financialDetails->income()->toFloat();
    }
}