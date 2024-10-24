<?php
declare(strict_types=1);

namespace Pfort\Blog\Dispatcher\Listeners;

use Pfort\Blog\Dispatcher\ListenerInterface;

final class LoggerListener implements ListenerInterface
{
    private string $logFile = ROOT_DIR . "/src/tmp/logs/info.log";

    public function subscribe(mixed $payload): void
    {
        $msg = sprintf(
            "[%s][%s]: %s",
            date('d.m.Y H:i:s'),
            $payload['type'],
            $payload['message']
        );

        file_put_contents($this->logFile, $msg, FILE_APPEND);
    }
}