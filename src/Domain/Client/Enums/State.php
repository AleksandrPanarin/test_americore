<?php

declare(strict_types=1);

namespace App\Domain\Client\Enums;

enum State: string
{
    case CA = 'CA';
    case NY = 'NY';
    case NV = 'NV';
    case AL = 'AL';
    case AK = 'AK';
    case AZ = 'AZ';
    case AR = 'AR';
    case CO = 'CO';
    case CT = 'CT';
    case DE = 'DE';
    case FL = 'FL';
    case GA = 'GA';

    public static function values()
    {
        return [
            self::CA,
            self::NY,
            self::NV,
            self::AL,
            self::AK,
            self::AZ,
            self::AR,
            self::CO,
            self::CT,
            self::DE,
            self::FL,
            self::GA,
        ];
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isCalifornia(): bool
    {
        return $this === self::CA;
    }

    public function isNewYork(): bool
    {
        return $this === self::NY;
    }

    public function isNevada(): bool
    {
        return $this === self::NV;
    }
}