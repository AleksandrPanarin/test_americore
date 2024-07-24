<?php

declare(strict_types=1);

namespace App\Bridge\Symfony\Controller;

use App\Application\Service\Client\CheckLoanIssue;
use App\Application\Service\Client\CheckLoanIssueService;
use App\Application\Service\Client\Exception\CheckingLoanIssueFailed;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

final class CheckingLoanIssueController extends AbstractController
{
    #[Route('/checking-loan-issue/{id}', methods: ['GET'])]
    public function __invoke(string $id, CheckLoanIssueService $service): JsonResponse
    {
        if (! Uuid::isValid($id)) {
            return $this->json(
                [
                    'property' => 'id',
                    'message' => 'Client UUID is invalid',
                ], Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $service->execute(new CheckLoanIssue($id));

            return $this->json(['message' => 'This client can take loan.'], Response::HTTP_OK);
        } catch (CheckingLoanIssueFailed $e) {
            return $this->json(
                [
                    'message' => 'You can not take a loan by reason of: ' . $e->getMessage(),
                ],
                Response::HTTP_OK
            );
        } catch (Throwable $e) {
            return $this->json(['message' => 'Something went wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}