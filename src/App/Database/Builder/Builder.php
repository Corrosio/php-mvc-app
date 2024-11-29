<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database\Builder;

use Pfort\Blog\App\Database\Query;

interface Builder
{
    public function getQuery(): Query;
}
