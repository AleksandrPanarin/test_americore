<?php

declare(strict_types=1);

namespace App\Bridge\Symfony\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ValidationExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpExceptionInterface && $exception->getPrevious() instanceof ValidationFailedException) {
            $validationException = $exception->getPrevious();
            $violations = $validationException->getViolations();

            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = [
                    'field' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }

            $response = new JsonResponse(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
            $event->setResponse($response);

            return;
        }

        if ($exception instanceof HttpExceptionInterface) {
            $response = new JsonResponse(
                ['message' => $exception->getMessage()],
                $exception->getStatusCode()
            );
        } else {
            $response = new JsonResponse(
                ['message' => 'An unexpected error occurred.'],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $event->setResponse($response);
    }
}