<?php

namespace App\Domain\Loan;

use App\Infrastructure\Doctrine\Repository\OrmLoanRepository;
use App\Infrastructure\Doctrine\Type\CustomDecimalType;
use App\Infrastructure\Doctrine\Type\LoanIdType;
use App\Infrastructure\Doctrine\Type\LoanTypeEnumType;
use Decimal\Decimal;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrmLoanRepository::class)]
#[ORM\Table(name: 'loans')]
final class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $incrementalId = null;

    #[ORM\Column(type: LoanIdType::LOAN_ID, nullable: false)]
    private LoanId $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $clientId;

    #[ORM\Column(type: LoanTypeEnumType::LOAN_TYPE, nullable: false)]
    private LoanType $type;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private int $loanTerm;

    #[ORM\Column(type: CustomDecimalType::DECIMAL, nullable: false)]
    private Decimal $interestRate;

    #[ORM\Column(type: CustomDecimalType::DECIMAL, nullable: false)]
    private Decimal $amount;

    #[ORM\Column(type: CustomDecimalType::DECIMAL, nullable: false)]
    private Decimal $totalAmount;

    public function __construct(
        LoanId $id,
        string $clientId,
        LoanType $type,
        int $loanTerm,
        Decimal $interestRate,
        Decimal $amount,
        Decimal $totalAmount
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->type = $type;
        $this->loanTerm = $loanTerm;
        $this->interestRate = $interestRate;
        $this->amount = $amount;
        $this->totalAmount = $totalAmount;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }
}