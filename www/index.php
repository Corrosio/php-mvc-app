<?php
declare(strict_types=1);

use Pfort\Blog\App\Http\Request;

use Pfort\Blog\App\Router\Router;
use Pfort\Blog\Factories\DiContainerFactory;
use Pfort\Blog\Factories\RoutesFactory;

require __DIR__ . "/../vendor/autoload.php";

$registeredRoutes = RoutesFactory::create();
$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$container = DiContainerFactory::create();

$router = $container->get(Router::class);

$route = $router->match($request, RoutesFactory::create());


if (is_null($route)) {
    echo "neexistující url";
} else {
    echo "<pre>";
    var_dump($route);
    echo "</pre>";
}
