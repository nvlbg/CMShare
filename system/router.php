<?php
class Router
{

    private $registry = null;
    private $defaultController = null;

    public function  __construct($registry)
    {
        $this->registry = $registry;
    }

    public function setDefaultController($controller)
    {
        $path = SPATH . 'application/controllers/' . $controller . '.php';
        if(!file_exists($path) || !is_readable($path))
        {
            throw new Exception('The file "' . $controller . '" does not exists or is not readable.');
        }

        $this->defaultController = $controller;
    }

    public function loadController()
    {
        $controller = $this->registry->segment->segment(1);
        if($controller == '')
        {
            include SPATH . 'application/controllers/' . $this->defaultController . '.php';
            $instance = new $this->defaultController();
            $instance->index();
        }
        else
        {
            $path = SPATH . 'application/controllers/' . $controller . '.php';
            if(!file_exists($path) || !is_readable($path))
            {
                throw new Exception("File not found");
            }
            else
            {
                include $path;
                $instance = new $controller();
                $action = $this->registry->segment->segment(2);
                if(is_callable(array($instance, $action)))
                {
                    $instance->$action();
                }
                else
                {
                    $instance->index();
                }
            }
        }
    }

}