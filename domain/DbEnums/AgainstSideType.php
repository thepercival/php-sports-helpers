<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\Against\AgainstSide;
use SportsHelpers\EnumDbType;

final class AgainstSideType extends EnumDbType
{
    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_AgainstSide';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): AgainstSide|null
    {
        if ($value === AgainstSide::Home->value) {
            return AgainstSide::Home;
        }
        if ($value === AgainstSide::Away->value) {
            return AgainstSide::Away;
        }
        return null;
    }

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(4)';
    }
}
