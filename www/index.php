<?php
declare(strict_types=1);

use Pfort\Blog\App\Router\Route;

require __DIR__ . "/../vendor/autoload.php";

$registeredRoutes = \Pfort\Blog\Factories\RoutesFactory::create();
$request = new \Pfort\Blog\App\Http\Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$router = new \Pfort\Blog\App\Router\Router();
$route = $router->match($request, $registeredRoutes);

if (is_null($route)) {
    echo "neexistující url";
} else {
    echo "<pre>";
    var_dump($route);
    echo "</pre>";
}
