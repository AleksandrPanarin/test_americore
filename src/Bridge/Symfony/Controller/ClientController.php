<?php

declare(strict_types=1);

namespace App\Bridge\Symfony\Controller;

use App\Application\Dto\ClientDto;
use App\Application\Service\Client\AddClient;
use App\Application\Service\Client\Exception\ClientCreatingFailed;
use App\Application\Service\Client\Exception\UpdateClientFailed;
use App\Application\Service\Client\UpdateClient;
use App\Application\UseCase\AddClientUseCase;
use App\Application\UseCase\UpdateClientUseCase;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

#[Route('/clients')]
final class ClientController extends AbstractController
{
    #[Route('', methods: ['POST'])]
    public function create(#[MapRequestPayload] ClientDto $clientDto, AddClientUseCase $service): JsonResponse
    {
        try {
            $service->execute(new AddClient($clientDto));

            return $this->json(['message' => 'Client created.'], Response::HTTP_CREATED);
        } catch (ClientCreatingFailed $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return $this->json(['message' => 'Failed to create client.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(string $id, #[MapRequestPayload] ClientDto $clientDto, UpdateClientUseCase $service): JsonResponse
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
            $service->execute(new UpdateClient($id, $clientDto));

            return $this->json(['message' => 'Client updated.'], Response::HTTP_OK);
        } catch (UpdateClientFailed $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return $this->json(['message' => 'Failed to update client.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}