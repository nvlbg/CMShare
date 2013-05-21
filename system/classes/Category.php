<?php
class CategoryObj
{

    private $categories = array();
    private $title;

    public function  __construct($categories, $title)
    {
        $this->categories = $categories;
        $this->title = $title;
    }

    public function toHTML()
    {
        $result = '<h3>' . $this->title . '</h3>';
        $result .= '<ul>';
        
        foreach($this->categories as $k => $v)
        {
            $result .= '<li><a href="' . PATH . 'category/' . $k . '/">' . $v . '</a></li>';
        }

        $result .= '</ul>';
        
        return $result;
    }

}