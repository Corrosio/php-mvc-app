<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\RouterInterface;

final class DynamicRouterDecorator implements RouterInterface
{
    private array $patterns = [
        '{num}' => '(\d+)',
        '{str}' => '([a-zA-Z]+)',
        '{any}' => '(.+)'
    ];

    public function __construct(private readonly RouterInterface $router) {}

    public function match(Request $request, RouteSet $routes): ?Route
    {
        $route = $this->router->match($request, $routes);

        if ($route instanceof Route) {
            return $route;
        }

        $requestMethod = $request->getRequestMethod();
        $placeholders = array_keys($this->patterns);
        $patterns = array_values($this->patterns);

        foreach ($routes as $route) {
            if ($route->hasMethod($requestMethod)) {
                $uriPattern = str_replace($placeholders, $patterns, $route->getRoute());
                $uriPattern = "#^{$uriPattern}$#";

                if (preg_match($uriPattern, $request->getRequestUri(), $matches)) {
                    $params = array_slice($matches, 1);
                    $route->setParams($params);
                    return $route;
                }
            }
        }
        return null;
    }
}