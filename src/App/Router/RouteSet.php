<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

use Traversable;

readonly final class RouteSet implements \IteratorAggregate
{

    public function __construct(private array $routes) {}

    public function getIterator(): Traversable
    {
        yield from $this->routes;
    }
}