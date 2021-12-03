<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EnumDbType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return static::getNameHelper();
    }

    abstract static public function getNameHelper(): string;

    /**
     * @psalm-suppress MixedPropertyFetch
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value;
    }

    public function getName()
    {
        return static::getNameHelper();
    }
}