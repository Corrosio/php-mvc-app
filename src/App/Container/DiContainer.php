<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Container;

use Pfort\Blog\App\Exceptions\ContainerException;
use Pimple\Container;

readonly final class DiContainer implements ContainerInterface
{
    public function __construct(private Container $container)
    {}

    public function get(string $key): object
    {
        if (! isset($this->container[$key])) {
            throw new ContainerException("Service '$key' not found");
        }

        return $this->container[$key];
    }
}