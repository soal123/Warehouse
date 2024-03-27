<?php

namespace warehouse;

use PDO;
use PDOException;
use PDOStatement;

class Db
{

    // $connection - pointer on connection with database
	private $connection;
	// $stmt - these will record our PDO-Object
	private $stmt;
	// $instance - for ban second copy object Db
	private static $instance = null;


    private function __construct()
    {}
    
    private function __clone()
    {
        
    }
    
    // private function __wakeUp()
    // {}

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }


	public function getConnection(array $db_config)
	{
	    
		$dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
		
		try
			{
				$this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
				return $this;
			}
			catch (PDOException $e)
			{
				// echo "DB Error: {$e->getMessage()}";
				abort(500);
			}
	}


	public function query($query, $params = [])
	{
	    try
	    {
	        $this->stmt = $this->connection->prepare($query);
    		$this->stmt->execute($params);
	    }
	    catch (PDOException $e)
	    {
	       // echo $e->getMessage();
	        return false;
	    }
		return $this;
	}
	
	
	public function findAll($param = null)
	{
	    return $this->stmt->fetchAll($param);
	}


    public function find()
	{
	    return $this->stmt->fetch();
	}
	
	
	public function findOrFail()
	{
	    $result = $this->find();
	    if(!$result)
	    {
	        abort();
	    }
	    return $result;
	}


    public function getColumn() // return bool(false), one row edited
    {
        return $this->stmt->fetchColumn();
    }
    
    public function rowCount() // return int(1), one row edited
    {
        return $this->stmt->rowCount();
    }

}

