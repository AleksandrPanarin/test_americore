<?php

declare(strict_types=1);

namespace App\Application\Service\Client;

use Psr\Log\LoggerInterface;

final class SendSmsNotificationService
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    public function execute(SendSmsNotification $command): void
    {
        $this->logger->info(
            sprintf(
                'Sending sms notification to client with uuid %s.', $command->clientId()
            )
        );
    }
}