<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Domain\Loan\LoanType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class LoanTypeEnumType extends Type
{
    public const string LOAN_TYPE = 'loan_type';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return "VARCHAR(50)";
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if (! in_array($value, LoanType::values())) {
            throw new InvalidArgumentException("Invalid value '" . $value . "' for ENUM type '" . $this->getName() . "'");
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?LoanType
    {
        if ($value === null) {
            return null;
        }

        return LoanType::from($value);
    }

    public function getName(): string
    {
        return self::LOAN_TYPE;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}