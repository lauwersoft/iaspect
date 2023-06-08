<?php

namespace Core\Database;

use Exception;
use PDO;
use ReflectionClass;
use stdClass;

abstract class QueryBuilder
{
    protected PDO $pdo;
    protected string $tableName;
    protected string $where = '';
    protected string $orderBy = '';
    protected string $limit = '';
    protected array $whereValues = [];
    protected array $parameters = [];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->tableName = $this->tableName ?? strtolower((new ReflectionClass($this))->getShortName()).'s';
    }

    public function where(array $conditions): QueryBuilder
    {
        $whereConditions = [];
        foreach ($conditions as $field => $value) {
            $whereConditions[] = "{$field} = :{$field}";
        }

        $this->where = ' WHERE ' . implode(' AND ', $whereConditions);
        $this->whereValues = $conditions;

        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): QueryBuilder
    {
        $this->orderBy = " ORDER BY $column $order";

        return $this;
    }

    public function limit(int $start, int $end): QueryBuilder
    {
        $this->limit = " LIMIT {$start},{$end}";

        return $this;
    }

    public function selectAll(array $columns = []): array
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = "SELECT $fields FROM {$this->tableName}";
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function select(array $columns = []): array
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("SELECT $fields FROM {$this->tableName}");
        $statement = $this->executeStatement($sql, $this->whereValues);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOne(array $columns = []): array
    {
        $this->limit(0, 1);
        return $this->select($columns);
    }

    public function first(array $columns = []): stdClass
    {
        return $this->selectOne($columns)[0];
    }

    public function insert(array $parameters): int
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->tableName,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $statement = $this->executeStatement($sql, $parameters);

        return $this->pdo->lastInsertId();
    }

    public function update(array $parameters): int
    {
        $setClauses = [];
        foreach ($parameters as $field => $value) {
            $setClauses[] = "{$field} = :update_{$field}";
        }

        $sql = $this->attachClauses(sprintf('UPDATE %s SET %s', $this->tableName, implode(', ', $setClauses)));

        $updateParams = $this->prepareUpdateParameters($parameters);
        $statement = $this->executeStatement($sql, $updateParams);

        return $statement->rowCount();
    }

    public function delete(): int
    {
        $sql = $this->attachClauses("DELETE FROM {$this->tableName}");

        $statement = $this->executeStatement($sql, $this->whereValues);

        return $statement->rowCount();
    }

    protected function executeStatement(string $sql, array $parameters = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement;
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    protected function prepareUpdateParameters(array $parameters): array
    {
        $updateParams = array_combine(array_map(function($key) { return "update_".$key; }, array_keys($parameters)), $parameters);
        return array_merge($this->whereValues, $updateParams);
    }

    protected function attachClauses(string $sql): string
    {
        return $sql . $this->where . $this->orderBy . $this->limit;
    }
}
