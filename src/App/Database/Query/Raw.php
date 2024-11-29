<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database\Query;

use Pfort\Blog\App\Database\Query;

readonly class Raw implements Query
{
    public function __construct(
        private string $queryString,
        private array  $params = []
    ) {
    }

    public function getQueryString(): string
    {
        return $this->queryString;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
