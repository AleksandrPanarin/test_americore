<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Listener;

use App\Application\Service\Client\SendEmailNotification;
use App\Application\Service\Client\SendEmailNotificationService;
use App\Application\Service\Client\SendSmsNotification;
use App\Application\Service\Client\SendSmsNotificationService;
use App\Domain\Loan\Loan;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SendLoanIssuedNotificationListener implements EventSubscriberInterface
{
    private string $clientId = '';

    public function __construct(
        private readonly SendSmsNotificationService $smsNotificationService,
        private readonly SendEmailNotificationService $emailNotificationService,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postFlush,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof Loan) {
            $this->clientId = $entity->clientId();
        }
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        if (! empty($this->clientId)) {
            $this->smsNotificationService->execute(new SendSmsNotification($this->clientId));
            $this->emailNotificationService->execute(new SendEmailNotification($this->clientId));
        }
    }
}