<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\EnumDbType;

class ResultType extends EnumDbType
{
    public static function getNameHelper(): string
    {
        return 'enum_AgainstResult';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === Result::Win->value) {
            return Result::Win;
        }
        if ($value === Result::Draw->value) {
            return Result::Draw;
        }
        if ($value === Result::Loss->value) {
            return Result::Loss;
        }
        return null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return 'int';
    }
}
