<?php

declare(strict_types=1);

namespace SportsHelpers\DbEnums;

use BackedEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EnumDbType extends Type
{
    abstract public static function getNameHelper(): string;

    /**
     * @psalm-suppress MixedPropertyFetch
     */
    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if( $value instanceof BackedEnum ) {  
            return $value->value;
        }
        return $value;
    }

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
