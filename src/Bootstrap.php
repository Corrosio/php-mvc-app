<?php
declare(strict_types=1);

namespace Pfort\Blog;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\App\Router\Router;
use Pfort\Blog\Config\ConfigInterface;
use Pfort\Blog\Config\Configuration;
use Pfort\Blog\Dispatcher\EventDispatcher;


final class Bootstrap
{
    private ConfigInterface $config;

    public function __construct(private ContainerInterface $container) {
        $this->config = $container->get(Configuration::class);
        $this->setDebugMode($this->config->get('app.debug'));
    }

    public function boot(): FrontController {
        return new FrontController(
            $this->container,
            $this->container->get(Router::class),
            $this->container->get(Request::class),
            $this->container->get(EventDispatcher::class)
        );
    }

    private function setDebugMode(bool $debugMode): void {
        if ($debugMode) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            error_reporting(E_NOTICE | E_ERROR | E_WARNING | E_PARSE);
        }
    }
}