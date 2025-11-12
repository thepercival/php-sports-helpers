<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use SportsHelpers\EnumDbType;

final class ResultType extends EnumDbType
{
    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_AgainstResult';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): Result|null
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

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(4)';
    }
}
