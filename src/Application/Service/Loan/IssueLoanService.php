<?php

declare(strict_types=1);

namespace App\Application\Service\Loan;

use App\Application\UseCase\IssueLoanUseCase;
use App\Domain\Loan\Factory\LoanFactoryInterface;
use App\Domain\Loan\Factory\LoanInput;
use App\Domain\Loan\InterestRateProvider\InterestRateInput;
use App\Domain\Loan\InterestRateProvider\InterestRateProviderInterface;
use App\Domain\Loan\LoanRepositoryInterface;

final class IssueLoanService implements IssueLoanUseCase
{

    public function __construct(
        private readonly LoanFactoryInterface $factory,
        private readonly LoanRepositoryInterface $loans,
        private readonly InterestRateProviderInterface $interestRateProvider,
    ) {
    }

    public function execute(IssueLoan $command): void
    {
        $interestRate = $this->interestRateProvider->provide(
            new InterestRateInput(
                $command->clientId(),
                $command->loanType()
            )
        );

        $result = $this->factory->create(
            new LoanInput(
                $command->clientId()->toString(),
                $command->loanType(),
                $command->loanTerm(),
                $interestRate,
                $command->amount(),
            )
        );

        $this->loans->add($result->loan());
    }
}