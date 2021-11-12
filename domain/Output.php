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

    use Color;

    public const COLOR_GRAY = 6; // light_gray

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

    public function outputString(string|int $value, int $minLength = null, int $colorNr = -1): void
    {
        $str = '' . $value;
        if ($minLength > 0) {
            while (strlen($str) < $minLength) {
                $str = ' ' . $str;
            }
        }
        $this->logger->info($this->getColored($colorNr, $str));
    }
}
