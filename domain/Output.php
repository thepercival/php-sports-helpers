<?php

declare(strict_types=1);

namespace SportsHelpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use SportsHelpers\Output\Color;

abstract class Output
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface|null $logger)
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
        if (!($this->logger instanceof Logger)) {
            return false;
        }
        foreach ($this->logger->getHandlers() as $handler) {
            if ($handler instanceof \Monolog\Handler\StreamHandler && $handler->getUrl() === "php://stdout") {
                return true;
            }
        }
        return false;
    }

    public function outputString(string|int $value, int $minLength = null, Color|null $color = null): void
    {
        $str = '' . $value;
        if ($minLength > 0) {
            while (strlen($str) < $minLength) {
                $str = ' ' . $str;
            }
        }
        $this->logger->info(Color::getColored($color, $str));
    }

    public function convertNumberToColor(int $number): Color
    {
        switch ($number) {
            case 1:
                return Color::Red;
            case 2:
                return Color::Green;
            case 3:
                return Color::Yellow;
            case 4:
                return Color::Blue;
            case 5:
                return Color::Magenta;
            case 6:
                return Color::Cyan;
            case 7:
            case 8:
            case 9:
            case 0:
                return Color::White;
        }
        throw new \Exception('number must be 0-9', E_ERROR);
    }
}
