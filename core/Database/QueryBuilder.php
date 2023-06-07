<?php

namespace Core\Database;

use PDO;
use ReflectionClass;

abstract class QueryBuilder
{
    protected PDO $pdo;
    protected string $tableName;
    protected string $where;
    protected string $orderBy;
    protected string $limit;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->tableName = $this->tableName ?? strtolower((new ReflectionClass($this))->getShortName()).'s';
    }

    public function where(array $conditions): QueryBuilder
    {
        $this->where = ' where '.implode(', ', $conditions);

        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): QueryBuilder
    {
        $this->orderBy = " order by $column $order";

        return $this;
    }

    public function limit(int $start, int $end): QueryBuilder
    {
        $this->limit = " limit {$start},{$end}";

        return $this;
    }

    public function selectAll(array $columns = []): array
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = "select $fields from {$this->tableName}";
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function select(array $columns = []): array
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select $fields from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOne(array $columns = []): array
    {
        $this->limit(0, 1);
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select {$fields} from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert(array $parameters): void
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->tableName,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );

        try {
            $this->executeStatement($sql, $parameters);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function update(array $parameters)
    {
        $values = array_map(function ($key, $value) {
            return "{$key} = {$value}";
        }, array_keys($parameters), $parameters);
        $sql = $this->attachClauses(sprintf('update %s set %s', $this->tableName, implode(', ', $values)));

        try {
            return $this->executeStatement($sql);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function delete()
    {
        $sql = $this->attachClauses("delete from {$this->tableName}");

        try {
            return $this->executeStatement($sql);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    protected function executeStatement(string $sql, array $parameters = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);

        return $statement;
    }

    protected function attachClauses(string $sql): string
    {
        if ($this->where) {
            $sql .= $this->where;
        }
        if ($this->orderBy) {
            $sql .= $this->orderBy;
        }
        if ($this->limit) {
            $sql .= $this->limit;
        }

        return $sql;
    }
}
