<?php
declare(strict_types=1);

namespace Pfort\Blog\Config;

interface ConfigInterface
{
    public function get(string $path): string|int|float|bool|null;
}