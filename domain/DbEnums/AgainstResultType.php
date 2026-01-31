<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\Against\AgainstResult;
use SportsHelpers\EnumDbType;

final class AgainstResultType extends EnumDbType
{
    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_AgainstResult';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): AgainstResult|null
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

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(4)';
    }
}
