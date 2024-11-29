<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database;

interface Executable
{
    public function execute(): Result;
}
