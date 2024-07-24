<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use App\Application\UseCase\AddClientUseCase;
use Psr\Log\LoggerInterface;
use Throwable;

final class LoggableAddClientService implements AddClientUseCase
{
    public function __construct(
        private readonly AddClientUseCase $decorated,
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute(AddClient $command): void
    {
        try {
            $this->decorated->execute($command);
        } catch (Throwable $e) {
            $this->logger->error(
                'An error occurred during adding a client.',
                [
                    'client_dto' => json_encode($command->clientDto()),
                    'message' => $e->getMessage(),
                    'exception' => $e,
                ]
            );

            throw $e;
        }
    }

}