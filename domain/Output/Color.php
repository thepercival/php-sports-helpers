<?php

declare(strict_types=1);

namespace SportsHelpers\Output;

use SportsHelpers\Output;

enum Color: string
{
    case Red = '0;31';
    case Green = '0;32';
    case Blue = '0;34';
    case Yellow = '1;33';
    case Purple = '0;35';
    case LightGray = '0;37';
    case Cyan = '0;36';
    case LightGreen = '1;32';
    case LightCyan = '1;36';
    case White = '1;37';
    //    'black'] = '0;30';
    //    'dark_gray'] = '1;30';
    //    'green'] = ;
    //    'light_red'] = '1;31';
    //    'purple'] = '0;35';
    //    'light_purple'] = '1;35';
    //    'brown'] = '0;33';

    //  } elseif ($number === Output::COLOR_GRAY) {
    //    $sColor = '0;37'; // light_gray

    public static function getColored(Color|null $color, string $content): string
    {
        if( $color === null ) {
            return $content;
        }
        $coloredString = "\033[" . $color->value . "m";
        return $coloredString . $content . "\033[0m";
    }

    public static function convertNumberToColor(int $number): Color
    {
        switch ($number) {
            case 1:
                return Color::Red; // '#298F00';
            case 2:
                return Color::Green; // '#84CF96';
            case 3:
                return Color::Blue; // '#0588BC';
            case 4:
                return Color::Yellow; // '#00578A';
            case 5:
                return Color::Purple; // '#298F00';
            case 6:
                return Color::LightGray; // '#84CF96';
            case 7:
                return Color::Cyan; // '#0588BC';
            case 8:
                return Color::LightGreen; // '#00578A';
            case 9:
                return Color::LightCyan; // '#00578A';
            case 0:
                return Color::White;
        }
        throw new \Exception('number must be 0-9', E_ERROR);
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
