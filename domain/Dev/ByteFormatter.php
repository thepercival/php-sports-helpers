<?php

namespace SportsHelpers\Dev;

final readonly class ByteFormatter implements \Stringable
{
    public function __construct(protected false|int $bytes, protected int $precision = 2)
    {
    }

    #[\Override]
    public function __toString()
    {
        if ($this->bytes === false) {
            return 'unknown size';
        }
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = (float)max($this->bytes, 0);
        $bytesLog = $bytes > 0 ? log($bytes) : 0.0;
        $kiloLog = log(1024);
        $pow = (int)floor($bytesLog / $kiloLog);
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= (float)pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));
        $unit = $pow < 0 ? '?' : $units[$pow];
        return ((string) round($bytes, $this->precision)) . ' ' . $unit;
    }
}
