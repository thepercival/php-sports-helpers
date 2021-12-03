<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\EnumDbType;

class SideType extends EnumDbType
{
    static public function getNameHelper(): string
    {
        return 'enum_AgainstSide';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === Side::Home->value) {
            return Side::Home;
        }
        if ($value === Side::Away->value) {
            return Side::Away;
        }
        return null;
    }
}