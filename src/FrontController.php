<?php
declare(strict_types=1);

namespace Pfort\Blog;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Controller\ControllerFactory;
use Pfort\Blog\App\Exceptions\ControllerFactoryException;
use Pfort\Blog\App\Http\Request;

use Pfort\Blog\App\Router\RouterInterface;
use Pfort\Blog\Dispatcher\EventDispatcher;
use Pfort\Blog\Factories\RoutesFactory;

readonly final class FrontController
{
    private ControllerFactory $factory;

    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private Request $request,
        private EventDispatcher $dispatcher
    ) {
        $this->factory = new ControllerFactory($container);
    }

    public function run(): void {
        try {
            $route = $this->router->match($this->request, RoutesFactory::create());

            if (is_null($route)) {
                Helper::http404();
            }

            $controllerProxy = $this->factory->createController($route->getControllerName());
            $controllerProxy->execute($this->request, $route->getControllerMethod(), $route->getParams());

        } catch (ControllerFactoryException | \ReflectionException $ex) {
            $this->dispatcher->dispatch('error.log', [
                'ErrorMessage' => $ex->getMessage(),
                'srcFile' => $ex->getFile(),
                'srcLine' => $ex->getLine(),
                'ErrorType' => 'ERROR'
            ]);

            Helper::http404();
        }

    }
}