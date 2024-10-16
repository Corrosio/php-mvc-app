<?php
declare(strict_types=1);

namespace Pfort\Blog\Factories;

use Pfort\Blog\App\Router\Route;
use Pfort\Blog\App\Router\RouteSet;

final class RoutesFactory
{

    public static function create(): RouteSet
    {
        return new RouteSet([
            new Route('/index', 'HomeController::indexAction'),
            new Route('/about', 'HomeController::aboutAction'),
            new Route('/contact', 'HomeController::contactAction'),
            new Route('/blog', 'HomeController::blogAction'),
        ]);
    }
}