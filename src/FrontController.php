<?php
declare(strict_types=1);

namespace Pfort\Blog;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\RouterInterface;
use Pfort\Blog\Dispatcher\EventDispatcher;
use Pfort\Blog\Factories\RoutesFactory;

readonly final class FrontController
{
    private const CONTROLLERS_NAMESPACE = 'Pfort\\Blog\\Controllers';

    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private Request $request,
        private EventDispatcher $dispatcher
    ) {}

    public function run(): void {
        $route = $this->router->match($this->request, RoutesFactory::create());

        $controller = $route->getHandler();

        $controller = explode('::', $controller);

        $controllerClass = self::CONTROLLERS_NAMESPACE . "\\" . $controller[0];
        $controllerMethod = $controller[1];

        $instance = new $controllerClass();
        $instance->execute($this->request, $controllerMethod, $route->getParams());

    }
}