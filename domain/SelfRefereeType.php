<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class SelfRefereeType extends EnumDbType
{
    public static function getNameHelper(): string
    {
        return 'enum_SelfReferee';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === SelfReferee::OtherPoules->value) {
            return SelfReferee::OtherPoules;
        }
        if ($value === SelfReferee::SamePoule->value) {
            return SelfReferee::SamePoule;
        }
        if ($value === SelfReferee::Disabled->value) {
            return SelfReferee::Disabled;
        }
        return null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return 'int';
    }
}
