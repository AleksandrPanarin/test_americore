<?php

declare(strict_types=1);

namespace App\Domain\Client\ClientChanger;

final class ClientChanger implements ClientChangerInterface
{
    public function changeClientData(ChangeClientInput $input): void
    {
        $client = $input->client();

        $client->changed(
            $input->fullName(),
            $input->age(),
            $input->address(),
            $input->ssn(),
            $input->clientContacts(),
            $input->financialDetails()
        );
    }
}