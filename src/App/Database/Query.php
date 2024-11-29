<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database;

interface Query
{
    public function getQueryString(): string;

    public function getParams(): array;
}
