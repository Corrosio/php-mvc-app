<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;

use Pfort\Blog\App\Container\ContainerInterface;
use Pfort\Blog\App\Exceptions\ControllerFactoryException;
use ReflectionException;

readonly final class ControllerFactory
{
    private const string CONTROLLER_NAMESPACE = 'Pfort\\Blog\\Controllers';

    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * @throws ControllerFactoryException
     * @throws ReflectionException
     */
    public function createController(string $controller): ControllerInterface
    {
        $controllerClass = self::CONTROLLER_NAMESPACE . "\\" . $controller;

        if (!class_exists($controllerClass)) {
            throw new ControllerFactoryException('Controller ' . $controller . ' does not exist');
        }

        $reflection = new \ReflectionClass($controllerClass);
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $controllerClass();
        }

        $dependencies = [];
        $parameters = $constructor->getParameters();
        foreach ($parameters as $parameter) {
            $paramType = $parameter->getType();

            if ($paramType instanceof \ReflectionNamedType && !$paramType->isBuiltin()) {
                $dependencies[] = $this->container->get($paramType->getName());
            }
        }

        $instance = $reflection->newInstanceArgs($dependencies);
        return new ControllerProxy($instance);
    }
}