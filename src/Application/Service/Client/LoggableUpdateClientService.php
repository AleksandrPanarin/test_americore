<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\UseCase\UpdateClientUseCase;
use Psr\Log\LoggerInterface;
use Throwable;

final class LoggableUpdateClientService implements UpdateClientUseCase
{
    public function __construct(
        private readonly UpdateClientUseCase $decorated,
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute(UpdateClient $command): void
    {
        try {
            $this->decorated->execute($command);
        } catch (Throwable $e) {
            $this->logger->error(
                'An error occurred during client update.',
                [
                    'client_id' => (string) $command->clientId(),
                    'client_dto' => json_encode($command->clientDto()),
                    'message' => $e->getMessage(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }
}