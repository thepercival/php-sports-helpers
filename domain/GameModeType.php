<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;

final class GameModeType extends EnumDbType
{
    // const NAME = 'enum_GameMode'; // modify to match your type name

    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_GameMode';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): GameMode|null
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

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(12)';
    }
}
