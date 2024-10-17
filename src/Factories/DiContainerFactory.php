<?php
declare(strict_types=1);

namespace Pfort\Blog\Factories;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Container\DiContainer;
use Pfort\Blog\App\Router\DynamicRouterDecorator;
use Pfort\Blog\App\Router\Router;
use Pimple\Container;

final class DiContainerFactory
{
    public static function create(): ContainerInterface
    {
        return new DiContainer(new Container([

            'router' => fn () => new Router(),

            Router::class => function (Container $container) {
                return new DynamicRouterDecorator($container['router']);
            },

        ]));
    }
}