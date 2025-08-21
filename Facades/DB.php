<?php

declare(strict_types=1);

namespace Facades;
use Core\Datatables;


class DB
{
    protected $table;
    protected $select = ['*'];
    protected $where = [];
    protected $params = [];

    public function table(string $tableName): self
    {
        $this->table = $tableName;
        return $this;
    }

    public function select(array $columns = ['*']): self
    {
        $this->select = $columns;
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->where[] = ['column' => $column, 'operator' => $operator, 'value' => $value];
        $this->params[":{$column}"] = $value; // Simple parameter binding example
        return $this;
    }

    public function get()
    {
        $sql = "SELECT " . implode(', ', $this->select) . " FROM " . $this->table;

        if (!empty($this->where)) {
            $whereClauses = [];
            foreach ($this->where as $condition) {
                $whereClauses[] = "{$condition['column']} {$condition['operator']} :{$condition['column']}";
            }
            $sql .= " WHERE " . implode(' AND ', $whereClauses);
        }

        $conn = Datatables::getInstance()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(array $data)
    {
        $SQL = "INSERT INTO {$this->table} (".implode(', ', array_keys($data)).") VALUES ( :".implode(', :',array_keys($data)).")";
        $conn = Datatables::getInstance()->getConnection();
        return $conn->prepare($SQL)->execute($data);
    }

    public function delete($column, $operator, $value)
    {
        $SQL = "DELETE FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
        $conn = Datatables::getInstance()->getConnection();
        $stmt =$conn->prepare($SQL);
        return $stmt->execute();
    }


    public static function  getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    private static $instance = null;
}

?>