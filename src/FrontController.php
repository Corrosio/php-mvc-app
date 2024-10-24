<?php
declare(strict_types=1);

namespace Pfort\Blog;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\RouterInterface;
use Pfort\Blog\Factories\RoutesFactory;

readonly final class FrontController
{
    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private Request $request,
    ) {}

    public function run(): void {
        $route = $this->router->match($this->request, RoutesFactory::create());
        var_dump($route);
    }
}