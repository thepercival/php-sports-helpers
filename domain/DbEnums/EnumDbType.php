<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Override;
use UnitEnum;

abstract class EnumDbType extends Type
{
    abstract public static function getNameHelper(): string;

    public function getName(): string
    {
        return static::getNameHelper();
    }


    #[Override]
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): string|null
    {
        if( $value instanceof UnitEnum ) {
            return (string)$value->value;
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
