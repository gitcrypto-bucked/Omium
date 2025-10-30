<?php

namespace Core;

use Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

class Datatables 
{

    public function logger()
    {
        $this->logger = new Logger("Connection Error");
        $formatter = new JsonFormatter();

        $stream_handler = new StreamHandler("php://stdout");
        $stream_handler->setFormatter($formatter);

        $this->logger->pushHandler($stream_handler);
    }

    public  function getConnection()
    {
        $this->logger();
        switch(trim(getenv('DB_CONNECTION')))
        {
            case 'mysql ': 
            case 'mysql':
               return  $this->mysqlConn();
            break;
            case 'postgres':
                return $this->postgresConn();
            break;          
            case 'sqlserver';
                return $this->sqlserverConn();
            break;
        }
    }

    private function mysqlConn()
    {
       try 
       {
            $dsn = 'mysql:host='.trim(getenv('DB_HOST')).';dbname='.trim(getenv('DB_DATABASE'));
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            $this->logger->error("Connection failed: " . $e->getMessage());
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }

    private function sqlserverConn()
    {
       try 
       {
            $dsn = 'sqlsrv:Server='.trim(getenv('DB_HOST')).';Database='.trim(getenv('DB_DATABASE'));
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            $this->logger->error("Connection failed: " . $e->getMessage());
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }

    private function postgresConn()
    {
       try 
       {
            $dsn = 'pgsql:host='.trim(getenv('DB_HOST')).';dbname='.trim(getenv('DB_DATABASE'));
            $username = trim(getenv('DB_USERNAME'));
            $password = trim(getenv('DB_PASSWORD'));

            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) 
        {
            $this->logger->error("Connection failed: " . $e->getMessage());
            echo "Connection failed: " . $e->getMessage(); die('Connection failed');
        }
        return $pdo;
    }

    protected $logger;

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