<?php
declare(strict_types=1);

namespace Pfort\Blog\Dispatcher;

use Pfort\Blog\Dispatcher\Listeners\LoggerListener;

final class DispatcherFactory
{
    public static function create(): EventDispatcher {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('error.log', new LoggerListener);

        return $dispatcher;
    }
}