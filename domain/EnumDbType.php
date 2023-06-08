<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use UnitEnum;

abstract class EnumDbType extends Type
{
    abstract public static function getNameHelper(): string;

    /**
     * @psalm-suppress MixedPropertyFetch
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if( $value instanceof UnitEnum ) {
            return $value->value;
        }
        return $value;
    }

    public function getName()
    {
        return static::getNameHelper();
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
