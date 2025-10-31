<?php

declare(strict_types=1);

namespace Facades;
use Core\Datatables;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

class DB
{
    protected $table = null;
    protected $sql = null;
    protected $select = ['*'];
    protected $where = [];
    protected $params = [];
    protected $logger;
    protected $order = [];

    public function __construct()
    {
        $this->logger = new Logger("Connection Error");
        $formatter = new JsonFormatter();

        $stream_handler = new StreamHandler("php://stdout");
        $stream_handler->setFormatter($formatter);

        $this->logger->pushHandler($stream_handler);
    }

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
      
        $this->sql = "SELECT " . implode(', ', $this->select) . " FROM " . $this->table;

        if (!empty($this->where)) 
        {
            $whereClauses = [];
            foreach ($this->where as $condition) {
                $whereClauses[] = "{$condition['column']} {$condition['operator']} :{$condition['column']}";
            }
            $this->sql .= " WHERE " . implode(' AND ', $whereClauses);
        }

        if(!empty($this->order))
        {
            $this->sql .= " ORDER BY {$this->order['column']} {$this->order['direction']}";
        }
        
        $conn = Datatables::getInstance()->getConnection();
        $stmt = $conn->prepare($this->sql);

        try
        {
            $stmt->execute($this->params);
            $this->sql = null;
            $this->whereClauses = [];
        }
        catch(\Exception $err)
        {
            $this->logger->error("DB failed: " . $err->getMessage());
        }
        $res =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
     
        return   $res;
    }

    public function paginate(int $limit, $page = 0 )
    {
        $conn = Datatables::getInstance()->getConnection();
        $this->sql = "SELECT " . implode(', ', $this->select) . " FROM " . $this->table;
        $stmt = $conn->prepare($this->sql);
        $stmt->execute($this->params);
        $reg = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        unset($stmt);

        if(!empty($reg))
        {
             $pages = intval(intval(sizeof($reg)) / intval($limit));
        }
        else
        {
            $pages = 1;
        }

        if (!empty($this->where)) 
        {
            $whereClauses = [];
            foreach ($this->where as $condition) {
                $whereClauses[] = "{$condition['column']} {$condition['operator']} :{$condition['column']}";
            }
            $this->sql .= " WHERE " . implode(' AND ', $whereClauses);
        }

        if(!empty($this->order))
        {
            $this->sql .= " ORDER BY {$this->order['column']} {$this->order['direction']}";
        }

        if(is_null($page) || intval($page) ==1 || intval($page) == 0)
        {
              $this->sql.= " LIMIT 0, {$limit} ";
        }
        else
        {
            //$offset = ($currentPage - 1) * $itemsPerPage;
            $till = ($page -1) * $limit;
            $this->sql.= " LIMIT {$till}, {$limit} ";
        }
        
        
        $stmt = $conn->prepare($this->sql);

        try
        {
            $stmt->execute($this->params);
            $this->sql = null;
            $this->whereClauses = [];
        }
        catch(\Exception $err)
        {
            $this->logger->error("DB failed: " . $err->getMessage());
        }
        $res =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
     
        return  ['items'=>$res, 'pages'=>$pages];
    }




    public function order(string $column, string $direction = 'ASC'): self
    {
        $this->order = ['column' => $column, 'direction' => $direction];
        return $this;
    }

    public function insert(array $data)
    {
        $SQL = "INSERT INTO {$this->table} (".implode(', ', array_keys($data)).") VALUES ( :".implode(', :',array_keys($data)).")";
        $conn = Datatables::getInstance()->getConnection();
        return $conn->prepare($SQL)->execute($data);
    }


    public function update(array $data)
    {
        $conn = Datatables::getInstance()->getConnection();
    
        $SQL = "UPDATE {$this->table} SET ".implode(', ', array_map(function($key) { return "{$key}=:{$key}"; }, array_keys($data)));

        if (!empty($this->where)) 
        {
            $whereClauses = [];
            foreach ($this->where as $condition) {
                $whereClauses[] = "{$condition['column']} {$condition['operator']} :{$condition['column']}";
            }
            $SQL .= " WHERE " . implode(' AND ', $whereClauses);
        }
        $data[$this->where[0]['column']] =  $this->where[0]['value'];
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
         self::$instance  = null;
        self::$instance = new DB();;
        return self::$instance;
    }

    private static $instance = null;
}

?>