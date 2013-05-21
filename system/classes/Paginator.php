<?php
class Paginator
{
    
    private $num_rows;
    private $per_page = 10;
    private $total_pages;
    private $page = 1;
    private $offset;
    
    private $path;
    
    public $range = 3;
    
    public function __construct($num_rows, $page, $path, $per_page = 10)
    {
        $this->num_rows = $num_rows;
        $this->per_page = $per_page;

        if($this->per_page == 0)
        {
            $this->per_page = 1;
        }

        $this->total_pages = ceil($this->num_rows / $this->per_page);
        $this->page = $page;
        $this->path = $path;
        
        if($this->page > $this->total_pages)
        {
            $this->page = $this->total_pages;
        }
        
        if($this->page < 1)
        {
            $this->page = 1;
        }
        
        $this->offset = ($this->page - 1) * $this->per_page;
        
    }
    
    public function getLimits()
    {
        return array($this->offset, $this->per_page);
    }
    
    public function buildLinks()
    {
        $result = '';
        
        if ($this->page > 1)
        {
           $result .= '<a href="' . $this->path . '1">&laquo;</a> ';
           
           $prevpage = $this->page - 1;
           $result .= ' <a href="' . $this->path . $prevpage. '"><</a> ';
        }
        
        for ($x = ($this->page - $this->range); $x < (($this->page + $this->range)  + 1); $x++)
        {
           if (($x > 0) && ($x <= $this->total_pages))
           {
              if ($x == $this->page)
              {
                 $result .= ' <span>' . $x . '</span> ';
              }
              else
              {
                 $result .= ' <a href="' . $this->path . $x . '">' . $x . '</a> ';
              }
           }
        }
        
        if ($this->page != $this->total_pages)
        {
            $nextpage = $this->page + 1;
            $result .= ' <a href="' . $this->path . $nextpage . '">></a> ';
            
            $result .= ' <a href="' . $this->path . $this->total_pages . '">&raquo;</a> ';
        }
        
        return $result;
    }
    
    public function hasPages()
    {
        return $this->total_pages > 1;
    }
    
}