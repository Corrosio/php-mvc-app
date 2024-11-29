<?php
declare(strict_types=1);

namespace Pfort\Blog\Providers;

use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\DynamicRouterDecorator;
use Pfort\Blog\App\Router\Router;
use Pfort\Blog\Dispatcher\DispatcherFactory;
use Pfort\Blog\Dispatcher\EventDispatcher;
use Pfort\Blog\View\View;
use Pfort\Blog\View\ViewFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class BaseProvider implements ServiceProviderInterface
{

    public function register(Container $pimple): void
    {
        $pimple[EventDispatcher::class] = fn () => DispatcherFactory::create();

        $pimple[View::class] = fn () => ViewFactory::create();

        $pimple[Request::class] = fn () => new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

        $pimple[Router::class] = fn () => new DynamicRouterDecorator(new Router());
    }
}