<?php
declare(strict_types=1);

namespace SportsHelpers\Output;

trait Color
{
    protected function outputColor(int $number, string $content): string
    {
        if ($number === 1) {
            $sColor = '0;31'; // red
        } elseif ($number === 2) {
            $sColor = '0;32'; // green
        } elseif ($number === 3) {
            $sColor = '0;34'; // blue;
        } elseif ($number === 4) {
            $sColor = '1;33'; // yellow
        } elseif ($number === 5) {
            $sColor = '0;35'; // purple
        } elseif ($number === 6) {
            $sColor = '0;37'; // light_gray
        } elseif ($number === 7) {
            $sColor = '0;36'; // cyan
        } elseif ($number === 8) {
            $sColor = '1;32'; // light green
        } elseif ($number === 9) {
            $sColor = '1;36'; // light cyan
        } elseif ($number === -1) {
            return $content;
        } else {
            $sColor = '1;37'; // white
        }

        //    'black'] = '0;30';
        //    'dark_gray'] = '1;30';
        //    'green'] = ;
        //    'light_red'] = '1;31';
        //    'purple'] = '0;35';
        //    'light_purple'] = '1;35';
        //    'brown'] = '0;33';

        $coloredString = "\033[" . $sColor . "m";
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
 *
 */
