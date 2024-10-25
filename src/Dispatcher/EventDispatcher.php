<?php
declare(strict_types=1);

namespace Pfort\Blog\Dispatcher;

final class EventDispatcher
{
    private array $listeners = [];

    public function addListener(string $eventName, ListenerInterface $listener): void {
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch(string $eventName, mixed $payload): void {
        if (! isset($this->listeners[$eventName])) {
            return;
        }

        foreach ($this->listeners[$eventName] as $listener) {
            $listener->subscribe($payload);
        }
    }
}