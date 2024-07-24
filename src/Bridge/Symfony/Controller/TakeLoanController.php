<?php

declare(strict_types=1);

namespace App\Bridge\Symfony\Controller;

use App\Application\Dto\LoanDto;
use App\Application\Service\Loan\Exception\LoanIssueFailed;
use App\Application\Service\Loan\IssueLoan;
use App\Application\UseCase\IssueLoanUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

final class TakeLoanController extends AbstractController
{
    #[Route('/take-loan', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] LoanDto $loanDto, IssueLoanUseCase $service): JsonResponse
    {
        try {
            $service->execute(new IssueLoan($loanDto->clientId, $loanDto->type, $loanDto->loanTerm, $loanDto->amount));

            return $this->json(['message' => 'Loan issued.'], Response::HTTP_OK);
        }catch (LoanIssueFailed $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }catch (Throwable $e) {
            return $this->json(['message' => 'Failed to issue loan.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}