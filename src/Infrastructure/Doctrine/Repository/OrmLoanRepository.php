<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Loan\Loan;
use App\Domain\Loan\LoanRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class OrmLoanRepository extends EntityRepository implements LoanRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Loan::class));
    }

    public function add(Loan $loan): void
    {
        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }

    public function update(Loan $loan): void
    {
        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }
}
