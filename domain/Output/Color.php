<?php

declare(strict_types=1);

namespace SportsHelpers\Output;

enum Color: string
{
    case Red = '0;31';
    case Green = '0;32';
    case Yellow = '0;33';
    case Blue = '0;34';
    case Magenta = '0;35';
    case Cyan = '0;36';
    case White = '0;37';

    public static function getColored(Color|null $color, string $content): string
    {
        if ($color === null) {
            return $content;
        }
        $coloredString = "\033[" . $color->value . "m";
        return $coloredString . $content . "\033[0m";
    }
}

/*
 * .q-w-1 {
  border-color: #298F00 !important;
}
.q-w-2 {
  border-color: #84CF96 !important;
}
.q-w-3 {
  border-color: #0588BC !important;
}
.q-w-4 {
  border-color: #00578A !important;
}
.q-w-5 {
  border-color: $gray-600 !important;
}
.q-l-5 {
  border-color: $gray-600 !important;
}
.q-l-4 {
  border-color: #FFFF66 !important;
}
.q-l-3 {
  border-color: #FFCC00 !important;
}
.q-l-2 {
  border-color: #FF9900 !important;
}
.q-l-1 {
  border-color: #FF0000 !important;
}
*/
