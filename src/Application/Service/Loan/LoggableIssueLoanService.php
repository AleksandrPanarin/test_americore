<?php

declare(strict_types=1);

namespace App\Application\Service\Loan;

use App\Application\Service\Client\Exception\CheckingLoanIssueFailed;
use App\Application\Service\Loan\Exception\LoanIssueFailed;
use App\Application\UseCase\IssueLoanUseCase;
use App\Domain\Client\Exception\ClientNotFound;
use App\Domain\Loan\Factory\Exception\ValidatingLoanInputFailed;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Throwable;

final class LoggableIssueLoanService implements IssueLoanUseCase
{
    public function __construct(
        private readonly IssueLoanUseCase $decorated,
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute(IssueLoan $command): void
    {
        try {
            $this->decorated->execute($command);
        } catch (ClientNotFound|InvalidArgumentException|ValidatingLoanInputFailed|CheckingLoanIssueFailed $e) {
            throw LoanIssueFailed::dueToIncorrectDataPassed($e);
        } catch (Throwable $e) {
            $this->logger->error(
                'An error occurred during checking loan issue.',
                [
                    'command' => json_encode($command),
                    'message' => $e->getMessage(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }
}