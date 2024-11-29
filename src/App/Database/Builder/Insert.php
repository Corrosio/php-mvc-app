<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database\Builder;

use Pfort\Blog\App\Database\Db;
use Pfort\Blog\App\Database\Exception\DbException;
use Pfort\Blog\App\Database\Exception\InvalidQueryException;
use Pfort\Blog\App\Database\Helper;
use Pfort\Blog\App\Database\Query;
use Pfort\Blog\App\Database\Result;

class Insert implements Builder
{
    private ?array $columns;
    private array $rows = [];

    public function __construct(
        private readonly Db $database,
        private readonly string $table,
    ) {
    }

    /**
     * @param array<string, float|int|string|null> $row
     */
    public function addRow(array $row): self
    {
        $this->validateColumnConsistency($row);
        $this->rows[] = array_values($row);

        return $this;
    }

    /**
     * @param array<array<string, float|int|string|null>> $rows
     */
    public function addRows(array $rows): self
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    /**
     * @param array<string, float|int|string|null> $row
     */
    private function validateColumnConsistency(array $row): void
    {
        $keys = array_keys($row);

        if (isset($this->columns)) {
            if (count(array_diff_assoc($this->columns, $keys))) {
                $expected = implode(', ', $this->columns);
                $got = implode(', ', $keys);
                throw new InvalidQueryException(
                    "Invalid Insert columns consistency, already set columns set: '{$expected}', now got different column set '{$got}'."
                );
            }
        } else {
            $this->columns = $keys;
        }
    }

    public function getQuery(): Query
    {
        if (count($this->rows) === 0) {
            throw new InvalidQueryException('Invalid query: \'INSERT\' must contains at least one row to insert.');
        }

        $builder = new Append();

        $builder->append(
            sprintf(
                'INSERT INTO %s (%s) VALUES',
                Helper::escapeMysqlSchemaNames($this->table),
                Helper::columnListToQuery($this->columns)
            )
        );

        $cols = count($this->columns);
        $rowPlaceholder = sprintf('(%s)', str_repeat('?, ', $cols - 1) . '?');

        $rows = count($this->rows);
        $builder->append(
            str_repeat("{$rowPlaceholder}, ", $rows - 1) . $rowPlaceholder,
            Helper::unpackMultiValues($this->rows)
        );

        return $builder->getQuery();
    }

    /**
     * @throws DbException
     */
    public function execute(): Result
    {
        return $this->database->executeQuery($this->getQuery());
    }
}
