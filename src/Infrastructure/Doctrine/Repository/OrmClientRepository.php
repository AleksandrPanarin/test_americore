<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Client\Client;
use App\Domain\Client\ClientContacts;
use App\Domain\Client\ClientId;
use App\Domain\Client\ClientRepositoryInterface;
use App\Domain\Client\Email;
use App\Domain\Client\Exception\ClientNotFound;
use App\Domain\Client\Ssn;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class OrmClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Client::class));
    }

    public function add(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }

    public function update(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }

    public function getById(ClientId $id): Client
    {
        /** @var Client $client */
        $client = $this->findOneBy(['id' => $id->toString()]);

        if ($client === null) {
            throw  ClientNotFound::byUuid($id);
        }

        return $client;
    }

    public function hasEmail(string $email): bool
    {
        $email = $this->findOneBy(['contacts.email' => $email]);

        return $email !== null;
    }

    public function hasSsn(Ssn $ssn): bool
    {
        $ssn = $this->findOneBy(['ssn.value' => $ssn->toString()]);

        return $ssn !== null;
    }
}
