<?php
declare(strict_types=1);

namespace Pfort\Blog\Factories;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Container\DiContainer;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\DynamicRouterDecorator;
use Pfort\Blog\App\Router\Router;
use Pfort\Blog\Config\Configuration;
use Pfort\Blog\Dispatcher\DispatcherFactory;
use Pfort\Blog\Dispatcher\EventDispatcher;
use Pfort\Blog\Providers\BaseProvider;
use Pfort\Blog\Providers\ConfigurationProvider;
use Pfort\Blog\Providers\DatabaseProvider;
use Pfort\Blog\View\View;
use Pfort\Blog\View\ViewFactory;
use Pimple\Container;

final class ContainerFactory
{
    public static function create(): ContainerInterface
    {
        $container = new Container();
        $container->register(new BaseProvider());
        $container->register(new ConfigurationProvider());
        $container->register(new DatabaseProvider());

        return new DiContainer($container);
    }
}