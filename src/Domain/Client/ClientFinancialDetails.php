<?php

declare(strict_types=1);

namespace App\Domain\Client;

use App\Infrastructure\Doctrine\Type\CustomDecimalType;
use Decimal\Decimal;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[Embeddable]
final class ClientFinancialDetails
{
    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private int $creditScore;

    #[ORM\Column(type: CustomDecimalType::DECIMAL, nullable: false)]
    private Decimal $income;

    public function __construct(int $creditScore, Decimal $income)
    {
        if ($creditScore < 0) {
            throw new InvalidArgumentException('Credit score cannot be negative.');
        }

        if ($income->isNegative()) {
            throw new InvalidArgumentException('Income cannot be negative.');
        }

        $this->creditScore = $creditScore;
        $this->income = $income;
    }

    public function creditScore(): int
    {
        return $this->creditScore;
    }

    public function income(): Decimal
    {
        return $this->income;
    }
}