<?php

declare(strict_types=1);

namespace App\Domain\Client\ClientChanger;

use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Factory\Exception\AlreadyExistClientInput;

final class ValidatingClientChanger implements ClientChangerInterface
{
    public function __construct(
        private readonly ClientChangerInterface $decorated,
        private readonly ClientRepositoryInterface $clients
    ) {
    }

    public function changeClientData(ChangeClientInput $input): void
    {
        $clientEmail = $input->client()->email();
        $changedEmail = $input->clientContacts()->email();

        if ($clientEmail !== $changedEmail && $this->clients->hasEmail($changedEmail)) {
            throw AlreadyExistClientInput::withEmail($changedEmail);
        }

        $clientSsn = $input->client()->ssn();
        $changedSsn = $input->ssn();

        if (!$clientSsn->equals($changedSsn) && $this->clients->hasSsn($changedSsn)) {
            throw AlreadyExistClientInput::withSsn($changedSsn);
        }

        $this->decorated->changeClientData($input);
    }
}