<?php

declare(strict_types=1);

namespace App\Domain\Loan\InterestRateProvider;

use Decimal\Decimal;

interface InterestRateProviderInterface
{
    public function provide(InterestRateInput $input): Decimal;
}
