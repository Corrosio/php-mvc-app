<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database\Builder\Clause;

trait Offset
{
    protected ?int $offset = null;

    public function offset(?int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }
}
