<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

final class Route
{
    private array $params;

    public function __construct(
        private readonly string $route,
        private readonly string $handler,
        private readonly array $routeMethods = ['GET']
    )
    {
        $this->params = [];
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

    public function getControllerName(): string {
        return explode('::', $this->getHandler())[0];
    }

    public function getControllerMethod(): string {
        return explode('::', $this->getHandler())[1];
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