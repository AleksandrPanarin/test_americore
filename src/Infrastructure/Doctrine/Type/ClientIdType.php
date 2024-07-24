<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Domain\Client\ClientId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * @codeCoverageIgnore
 */
final class ClientIdType extends Type
{
    public const string CLIENT_ID = 'client_id';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?ClientId
    {
        return $value !== null ? ClientId::fromString($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value !== null ? (string) $value : null;
    }

    public function getName(): string
    {
        return self::CLIENT_ID;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
