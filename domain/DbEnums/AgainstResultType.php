<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\Against\AgainstResult;

class AgainstResultType extends EnumDbType
{
    public static function getNameHelper(): string
    {
        return 'enum_AgainstResult';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === AgainstResult::Win->value) {
            return AgainstResult::Win;
        }
        if ($value === AgainstResult::Draw->value) {
            return AgainstResult::Draw;
        }
        if ($value === AgainstResult::Loss->value) {
            return AgainstResult::Loss;
        }
        return null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return 'varchar(4)';
    }
}
