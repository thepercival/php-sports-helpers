<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class GameModeType extends EnumDbType
{
    // const NAME = 'enum_GameMode'; // modify to match your type name

    public static function getNameHelper(): string
    {
        return 'enum_GameMode';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === GameMode::Single->value) {
            return GameMode::Single;
        }
        if ($value === GameMode::Against->value) {
            return GameMode::Against;
        }
        if ($value === GameMode::AllInOneGame->value) {
            return GameMode::AllInOneGame;
        }
        return null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return 'varchar(12)';
    }
}
