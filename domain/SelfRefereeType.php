<?php

declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\DBAL\Platforms\AbstractPlatform;

final class SelfRefereeType extends EnumDbType
{
    #[\Override]
    public static function getNameHelper(): string
    {
        return 'enum_SelfReferee';
    }

    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): SelfReferee|null
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

    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar(11)';
    }
}
