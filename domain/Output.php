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
