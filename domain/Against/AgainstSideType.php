<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\EnumDbType;

class AgainstSideType extends EnumDbType
{
    public static function getNameHelper(): string
    {
        return 'enum_AgainstSide';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === AgainstSide::Home->value) {
            return AgainstSide::Home;
        }
        if ($value === AgainstSide::Away->value) {
            return AgainstSide::Away;
        }
        return null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return 'varchar(4)';
    }
}
