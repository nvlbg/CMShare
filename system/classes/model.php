<?php
abstract class Model
{  
    
    protected $db = null;
    protected $load = null;
    private $registry = null;
    
    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->db = $this->registry->database->getConnection();
        $this->load = Load::getInstance();
    }
    
    protected function segment($n)
    {
        return $this->registry->segment->segment($n);
    }
    
}