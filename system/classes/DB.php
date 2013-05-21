<?php

// This class is not Singleton due to incompatibility in PHP 5.2 in system/Router.php
class DB
{
    private $connection = NULL;
    // private static $instane = NULL;

    // private function __construct() { }
    // private function __clone() { }

    public function connect($server, $username, $password, $database)
    {
        $this->connection = @new mysqli($server, $username, $password, $database);
        if(mysqli_connect_error())
    	{
            throw new Exception('Error connecting to host.');
        }
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
    
    public function close()
    {
        $this->connection->close();
    }
	
    /*
	
    public static function getInstance()
    {
        if(self::$instane === NULL)
        {
            self::$instane = new DB();
        }
        return self::$instane;
    }
	
    */
    
}