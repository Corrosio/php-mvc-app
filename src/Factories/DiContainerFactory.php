<?php
declare(strict_types=1);

namespace Pfort\Blog\Factories;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Container\DiContainer;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\DynamicRouterDecorator;
use Pfort\Blog\App\Router\Router;
use Pfort\Blog\Config\Configuration;
use Pimple\Container;

final class DiContainerFactory
{
    public static function create(): ContainerInterface
    {
        return new DiContainer(new Container([

            'config' => fn () => new Configuration(
                ROOT_DIR . '/dev_config.php',
                ROOT_DIR . '/prod_config.php'
            ),

            'router' => fn () => new Router(),

            'request' => function(Container $container) {
                return new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
            },

            Router::class => function (Container $container) {
                return new DynamicRouterDecorator($container['router']);
            },

        ]));
    }
}