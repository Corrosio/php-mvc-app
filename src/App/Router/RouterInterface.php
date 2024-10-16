<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Router;

use Pfort\Blog\App\Http\Request;

interface RouterInterface
{
    public function match(Request $request, RouteSet $routes): ?Route;
}