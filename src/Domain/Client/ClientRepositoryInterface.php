<?php

declare(strict_types=1);

namespace App\Domain\Client;

use App\Domain\Client\Exception\ClientNotFound;
use App\Domain\Client\LoanIssueChecker\Ssn;

interface ClientRepositoryInterface
{
    public function add(Client $client): void;

    public function update(Client $client): void;

    /**
     * @throws ClientNotFound
     */
    public function getById(ClientId $id): Client;

    public function hasEmail(string $email): bool;

    public function hasSsn(Ssn $ssn): bool;
}