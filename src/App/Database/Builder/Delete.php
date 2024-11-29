<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database\Builder;

use Pfort\Blog\App\Database\Db;
use Pfort\Blog\App\Database\Exception\DbException;
use Pfort\Blog\App\Database\Exception\TooRiskyException;
use Pfort\Blog\App\Database\Executable;
use Pfort\Blog\App\Database\Helper;
use Pfort\Blog\App\Database\Query;
use Pfort\Blog\App\Database\Result;

class Delete implements Builder, Executable
{
    use Clause\Limit;
    use Clause\OrderBy;
    use Clause\Where;

    private bool $includeAllRows = false;

    public function __construct(
        private readonly Db $database,
        private readonly string $table
    ) {
    }

    public function getQuery(): Query
    {
        if ($this->includeAllRows === false && $this->limit === null && $this->hasWhereClause() === false) {
            throw new TooRiskyException(
                'Execute deletion without any `WHERE` or `LIMIT` clause is too risky. '
                . 'Did you forget call the `->where()` method at least once? If you did it on purpose, '
                . 'confirm the intention with call `includeAllRows()` method.'
            );
        }

        $builder = new Append();

        $builder->append(sprintf('DELETE FROM %s', Helper::escapeMysqlSchemaNames($this->table)));

        if ($this->hasWhereClause()) {
            $builder->append($this->getWhereString(), $this->getWhereParams());
        }

        if ($this->hasOrderByClause()) {
            $builder->append($this->getOrderByString());
        }

        if ($this->limit !== null) {
            $builder->append("LIMIT ?", [$this->limit]);
        }

        return $builder->getQuery();
    }

    /**
     * By default, the builder does not allows delete all rows without any WHERE or limitation.
     * If you did it on purpose, confirm the intention with call this method.
     */
    public function includeAllRows(bool $value = true): self
    {
        $this->includeAllRows = $value;
        return $this;
    }

    /**
     * @throws DbException
     */
    public function execute(): Result
    {
        return $this->database->executeQuery($this->getQuery());
    }
}
