<?php
declare(strict_types=1);

namespace Pfort\Blog;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\Router;
use Pfort\Blog\App\Router\RouterInterface;
use Pfort\Blog\Factories\DiContainerFactory;

final class Bootstrap
{
    private static ContainerInterface $container;

    private static RouterInterface $router;

    private static Request $request;

    public static function boot(): FrontController {
        self::init();
        return new FrontController(self::$container, self::$router, self::$request);
    }

    private static function init(): void {
        if (!isset(self::$container)) {
            self::$container = DiContainerFactory::create();
        }
        if (!isset(self::$router)) {
            self::$router = self::$container->get(Router::class);
        }
        if (!isset(self::$request)) {
            self::$request = self::$container->get('request');
        }
    }
}