<?php
declare(strict_types=1);

namespace Pfort\Blog\Dispatcher;

interface ListenerInterface
{
    public function subscribe(mixed $payload): void;
}