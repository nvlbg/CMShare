<?php
class segment
{
    
    private $segments = null;
    
    public function __construct()
    {
        $segments = isset($_GET['segments']) ? $_GET['segments'] : '';
        $this->segments = explode('/', $segments);
    }
    
    public function segment($n)
    {
        if(isset($_GET['segments']) && $n > 0 && $n <= count($this->segments))
        {
            return $this->segments[$n-1];
        }
        else
        {
            return '';
        }
    }
    
    public function setSegment($pos, $value)
    {
        if(array_key_exists($pos, $this->segments))
        {
            $this->segments[$pos] = $value;
        }
    }
    
}