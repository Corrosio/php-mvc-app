<?php
declare(strict_types=1);

namespace Pfort\Blog\Dispatcher\Listeners;

use Pfort\Blog\Dispatcher\ListenerInterface;

final class LoggerListener implements ListenerInterface
{
    private string $logFile = ROOT_DIR . "/src/tmp/logs/error.log";

    public function subscribe(mixed $payload): void
    {
        $msg = sprintf(
            "[%s][%s]: %s on line %d ~ %s",
            date('d.m.Y H:i:s'),
            $payload['ErrorType'],
            $payload['ErrorMessage'],
            $payload['srcLine'],
            $payload['srcFile'],
        );

        file_put_contents($this->logFile, $msg, FILE_APPEND);
    }
}