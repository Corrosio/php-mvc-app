<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

use Pfort\Blog\App\Http\Request;

final class Router implements RouterInterface
{
    public function match(Request $request, RouteSet $routes): ?Route
    {
        $requestMethod = $request->getRequestMethod();
        $requestUri = $request->getRequestUri();

        foreach ($routes as $route) {
            if ($route->hasMethod($requestMethod) &&  $route->isEqual($requestUri)) {
                return $route;
            }
        }
        return null;
    }
}