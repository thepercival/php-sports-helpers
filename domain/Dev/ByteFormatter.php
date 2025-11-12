<?php

namespace SportsHelpers\Dev;

final class ByteFormatter implements \Stringable
{
    public function __construct(protected false|int $bytes, protected int $precision = 2)
    {
    }

    #[\Override]
    public function __toString(): string
    {
        if ($this->bytes === false) {
            return 'unknown size';
        }
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($this->bytes, 0);
        $pow = floor(($bytes > 0 ? log((float)$bytes) : 0.0) / log(1024.0));
        $pow = (int)min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));
        return ((string)round($bytes, $this->precision)) . ' ' . $units[$pow];
    }
}
