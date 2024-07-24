<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\Service\Client\Exception\CheckingLoanIssueFailed;
use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Exception\ClientNotFound;
use App\Domain\Client\LoanIssueChecker\Exception\LoanIssueCheckerFailed;
use App\Domain\Client\LoanIssueChecker\LoanIssueCheckClientInput;
use App\Domain\Client\LoanIssueChecker\LoanIssueChecker;

final class CheckLoanIssueService
{
    public function __construct(
        private readonly LoanIssueChecker $loanIssueChecker,
        private readonly ClientRepositoryInterface $clients
    ) {
    }

    public function execute(CheckLoanIssue $command): void
    {
        try {
            $client = $this->clients->getById($command->clientId());

            $this->loanIssueChecker->check(
                new LoanIssueCheckClientInput(
                    $client->age(),
                    $client->address(),
                    $client->ssn(),
                    $client->financialDetails(),
                )
            );
        } catch (LoanIssueCheckerFailed|ClientNotFound $e) {
            throw CheckingLoanIssueFailed::dueToIncorrectDataPassed($e);
        }
    }
}