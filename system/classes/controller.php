<?php
abstract class Controller
{

    protected $load = null;
    protected $model = null;
    protected $registry = null;
    
    protected function segment($n)
    {
        return $this->registry->segment->segment($n);
    }
    
    protected function setSegment($pos, $value)
    {
        $this->registry->segment->setSegment($pos, $value);
    }
    
    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->load = Load::getInstance();
    }

}