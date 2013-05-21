<?php
class Registry
{
    private static $instance = NULL;
    private $arr = array();
    
    private function __construct() { }
    
    private function __clone() { }
    
    public static function getInstance()
    {
        if(self::$instance === NULL)
        {
            self::$instance = new Registry();
        }
        return self::$instance;
    }
    
    public function __set($key, $value)
    {
        $this->arr[$key] = $value;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->arr))
        {
            return $this->arr[$key];
        }
    }

    public function putObject($key, $obj_name)
    {
        if(is_object($obj_name))
        {
            $this->arr[$key] = $obj_name;
        }
        else
        {
            $path = SPATH . 'system/classes/' . $obj_name . '.php';
            if(!file_exists($path) || !is_readable($path))
            {
                throw new Exception('The file ' . $path . ' does not exists or is not readable.');
            }

            include $path;
			
			$this->arr[$key] = new $obj_name();

            /*
			
			if(method_exists($obj_name, 'getInstance'))
            {
                $this->arr[$key] = $obj_name::getInstance();
            }
            else
            {
                $this->arr[$key] = new $obj_name();
            }
			
			*/
        }
    }
    
}