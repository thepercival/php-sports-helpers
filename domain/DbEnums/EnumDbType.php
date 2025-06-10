<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use BackedEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use UnitEnum;

abstract class EnumDbType extends Type
{
    abstract public static function getNameHelper(): string;

    public function getName(): string
    {
        return static::getNameHelper();
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
