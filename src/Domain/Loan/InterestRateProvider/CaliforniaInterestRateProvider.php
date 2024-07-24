<?php

declare(strict_types=1);

namespace App\Domain\Loan\InterestRateProvider;

use App\Domain\Client\ClientRepositoryInterface;
use Decimal\Decimal;

final class CaliforniaInterestRateProvider implements InterestRateProviderInterface
{
    private const string ADDITIONAL_PERCENTAGE = "11.49";

    public function __construct(
        private readonly InterestRateProviderInterface $decorated,
        private readonly ClientRepositoryInterface $clients
    ) {
    }

    public function provide(InterestRateInput $input): Decimal
    {
        $client = $this->clients->getById($input->clientId());

        $interestRate = $this->decorated->provide($input);

        if ($client->state()->isCalifornia()) {
            $interestRate = $interestRate->add(new Decimal(self::ADDITIONAL_PERCENTAGE));
        }

        return $interestRate;
    }
}