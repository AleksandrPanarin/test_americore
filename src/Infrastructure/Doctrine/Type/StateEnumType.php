<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Domain\Client\Enums\State;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class StateEnumType extends Type
{
    public const string STATE_TYPE = 'state_type';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return "VARCHAR(50)";
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if (! in_array($value, State::values())) {
            throw new InvalidArgumentException("Invalid value '" . $value . "' for ENUM type '" . $this->getName() . "'");
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?State
    {
        if ($value === null) {
            return null;
        }

        return State::from($value);
    }

    public function getName(): string
    {
        return self::STATE_TYPE;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}