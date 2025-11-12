<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\EnumDbType;

final class SideType extends EnumDbType
{
    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_AgainstSide';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): Side|null
    {
        if ($value === Side::Home->value) {
            return Side::Home;
        }
        if ($value === Side::Away->value) {
            return Side::Away;
        }
        return null;
    }

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(4)';
    }
}
