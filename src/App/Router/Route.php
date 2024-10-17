<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

readonly final class Route
{
    private array $params;

    public function __construct(
        private string $route,
        private string $handler,
        private array  $routeMethods = ['GET']
    )
    {
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function isEqual(string $uri): bool
    {
        return $uri === $this->route;
    }

    public function hasMethod(string $method) : bool
    {
        return in_array($method, $this->routeMethods);
    }

    public function  getHandler() : string
    {
        return $this->handler;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

}