<?php

declare(strict_types=1);

namespace SportsHelpers\Output;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class OutputAbstract
{
    protected LoggerInterface $logger;
    private bool $useColors = true;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    protected function setUseColors(LoggerInterface $logger): void
    {
        if ($logger instanceof Logger) {
            foreach ($logger->getHandlers() as $handler) {
                if (!($handler instanceof StreamHandler && $handler->getUrl() === "php://stdout")) {
                    $this->useColors = false;
                }
            }
        }
    }

    public function getColoredString(Color|null $color, string $content): string
    {
        if ($color === null || $this->useColors === false) {
            return $content;
        }
        $coloredString = "\033[" . $color->value . "m";
        return $coloredString . $content . "\033[0m";
    }

    public function outputString(string|int $value, int|null $minLength = null, Color|null $color = null): void
    {
        $str = '' . $value;
        $str = $this->stringToMinLength($str, $minLength);
        $this->logger->info($this->getColoredString($color, $str));
    }

    public function stringToMinLength(string $value, int|null $minLength = null): string
    {
        if ($minLength > 0) {
            while (strlen($value) < $minLength) {
                $value = ' ' . $value;
            }
        }
        return $value;
    }

    public function convertNumberToColor(int $number): Color
    {
        switch ($number) {
            case 1:
                return Color::White;
            case 2:
                return Color::Red;
            case 3:
                return Color::Green;
            case 4:
                return Color::Blue;
            case 5:
                return Color::Yellow;
            case 6:
                return Color::Magenta;
            case 7:
                return Color::Cyan;
        }
        return Color::White;
    }
}
