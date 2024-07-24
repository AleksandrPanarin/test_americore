<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use Psr\Log\LoggerInterface;

final class SendEmailNotificationService
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute(SendEmailNotification $command): void
    {
        $this->logger->info(
            sprintf(
                'Sending email notification to client with uuid %s.', $command->clientId()
            )
        );
    }
}