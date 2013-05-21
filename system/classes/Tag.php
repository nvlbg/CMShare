<?php
class TagObj
{

    private $tags = array();
    private $title;

    public function  __construct($tags, $title)
    {
        $this->tags = $tags;
        $this->title = $title;
    }

    public function toHTML()
    {
        $min = 10000;
        $max = -10000;
        
        $words = array_keys($this->tags);

        foreach($words as $word)
        {
            if($this->tags[$word]['count'] > $max)
            {
                $max = $this->tags[$word]['count'];
            }
            if($this->tags[$word]['count'] < $min)
            {
                $min = $this->tags[$word]['count'];
            }
        }
        
		$d = $max - $min == 0 ? 3 : $max - $min;
		
        $ratio = 18.0 / $d;
        sort($words);
        
        $result = '<h3>' . $this->title . '</h3>';
        
        foreach($words as $word)
        {
            $fs = (int) (9 + ($this->tags[$word]['count'] * $ratio));
            $result .= '<a href="' . PATH . 'tag/' . $this->tags[$word]['id'] . '/" style="font-size:' . $fs . 'pt;" class="tag-link">' . $word . '</a>';
        }
        
        return $result;
    }

}