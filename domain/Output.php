<?php
declare(strict_types=1);

namespace SportsHelpers;

use JetBrains\PhpStorm\Pure;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class Output
{
    protected LoggerInterface $logger;

    public function __construct(?LoggerInterface $logger)
    {
        if ($logger === null) {
            $logger = new Logger('sports-logger');
            $handler = new StreamHandler('php://stdout', Logger::INFO);
            $logger->pushHandler($handler);
        }
        $this->logger = $logger;
    }

    protected function useColors(): bool
    {
        if ($this->logger instanceof Logger) {
            foreach ($this->logger->getHandlers() as $handler) {
                if (!($handler instanceof \Monolog\Handler\StreamHandler)
                    || $handler->getUrl() !== "php://stdout") {
                    return false;
                }
            }
        }
        return true;
    }

    protected function outputColor(int $number, string $content): string
    {
        $sColor = null;
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

    public function outputString(string|int $value, int $minLength = null): void
    {
        $str = '' . $value;
        if ($minLength > 0) {
            while (strlen($str) < $minLength) {
                $str = ' ' . $str;
            }
        }
        $this->logger->info($str);
    }
}
