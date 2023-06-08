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
    protected string $where;
    protected string $orderBy;
    protected string $limit;
    protected array $whereValues = [];
    protected array $updateValues = [];

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
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOne(array $columns = []): array
    {
        $this->limit(0, 1);
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("SELECT {$fields} FROM {$this->tableName}");
        $parameters = $this->whereValues; // include where values
        $statement = $this->executeStatement($sql, $parameters); // add parameters to function call

        return $statement->fetchAll(PDO::FETCH_CLASS);
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

        try {
            $parameters = $this->bindValues($parameters);
            $this->executeStatement($sql, $parameters);

            return $this->pdo->lastInsertId();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function update(array $parameters)
    {
        $setClauses = [];
        foreach ($parameters as $field => $value) {
            $setClauses[] = "{$field} = :update_{$field}";
        }

        $sql = $this->attachClauses(sprintf('UPDATE %s SET %s', $this->tableName, implode(', ', $setClauses)));

        try {
            return $this->executeStatement($sql, $parameters, true);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function delete()
    {
        $sql = $this->attachClauses("DELETE FROM {$this->tableName}");

        try {
            $parameters = $this->bindValues($this->whereValues, true);
            return $this->executeStatement($sql, $parameters);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    protected function executeStatement(string $sql, array $parameters = [], bool $isUpdateOrDelete = false)
    {
        $statement = $this->pdo->prepare($sql);

        if($isUpdateOrDelete){
            $updateParams = array_combine(array_map(function($key) { return "update_".$key; }, array_keys($parameters)), $parameters);
            $parameters = array_merge($this->whereValues, $updateParams);
        }

        $statement->execute($parameters);

        return $statement;
    }

    protected function bindValues(array $parameters, $isUpdate = false)
    {
        $preparedParameters = [];
        if($isUpdate) {
            $preparedParameters = array_merge($this->whereValues, array_combine(array_map(function($key) { return "update_".$key; }, array_keys($this->updateValues)), $this->updateValues));
        } else {
            foreach ($parameters as $key => $value) {
                $preparedParameters[':'.$key] = $value;
            }
        }
        return $preparedParameters;
    }

    protected function attachClauses(string $sql): string
    {
        $sql .= $this->where ?? '';
        $sql .= $this->orderBy ?? '';
        $sql .= $this->limit ?? '';

        return $sql;
    }
}
