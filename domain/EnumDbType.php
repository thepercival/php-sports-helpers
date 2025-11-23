<?php

declare(strict_types=1);

namespace SportsHelpers;

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
     * @psalm-suppress MixedPropertyFetch
     */
    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if( $value instanceof UnitEnum ) {
            return $value->value;
        }
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
