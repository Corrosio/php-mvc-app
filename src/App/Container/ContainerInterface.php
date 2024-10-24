<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Container;

interface ContainerInterface
{
    public function get(string $key): mixed;
}