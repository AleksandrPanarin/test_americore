<?php

declare(strict_types=1);

namespace App\Application\Service\Loan;

use App\Application\Service\Client\Exception\CheckingLoanIssueFailed;
use App\Application\UseCase\IssueLoanUseCase;
use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;
use App\Domain\Client\LoanIssueChecker\LoanIssueCheckClientInput;
use App\Domain\Client\LoanIssueChecker\LoanIssueCheckerInterface;

final class CheckIssueLoanService implements IssueLoanUseCase
{
    public function __construct(
        private readonly IssueLoanUseCase $decorated,
        private readonly LoanIssueCheckerInterface $loanIssueChecker,
        private readonly ClientRepositoryInterface $clients
    ) {
    }

    public function execute(IssueLoan $command): void
    {
        try {
            $client = $this->clients->getById($command->clientId());

            $this->loanIssueChecker->check(
                new LoanIssueCheckClientInput(
                    $client->age(),
                    $client->address(),
                    $client->ssn(),
                    $client->financialDetails()
                )
            );
        } catch (LoanIssueCheckerFailed $e) {
            throw CheckingLoanIssueFailed::dueToIncorrectDataPassed($e);
        }

        $this->decorated->execute($command);
    }
}