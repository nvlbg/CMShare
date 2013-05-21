<?php
class Validate
{
    
    private static $html_purifier = NULL;
    
    public static function strlen($str, $max)
    {
        if(mb_strlen(trim($str), 'utf8') > $max)
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
    public static function strlen_min($str, $min)
    {
        if(mb_strlen(trim($str), 'utf8') < $min)
        {
            return FALSE;
        }
        
        return TRUE;
    }
	
    public static function BBCode($str)
    {
        $patterns = array(
            '/\[b\]/',
            '/\[\/b\]/',
            '/\[i\]/',
            '/\[\/i\]/',
            '/\[u\]/',
            '/\[\/u\]/',
            '/\[url\=((http|https):\/\/[^<>()\s]+?)\](.+?)\[\/url\]/'
            //'/\[url\=((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)\](.+?)\[\/url\]/'
        );
        $replacements = array(
            '<strong>',
            '</strong>',
            '<em>',
            '</em>',
            '<u>',
            '</u>',
            '<a href="$1">$3</a>'
        );
        
        /*$links = array();
        if(preg_match('/\[url\=(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?\](.+?)\[\/url\]/', $str, $links))
        {
            echo '<pre>' . print_r($links, true) . '</pre>';
        }*/
        
        return preg_replace($patterns, $replacements, $str);
    }
    
    public static function link($link)
    {
        return preg_match('/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/', $link);
    }
    
    public static function color($color)
    {
        return preg_match('/^#[a-f0-9]{6}$/i', $color);
    }
    
    public static function email($email)
    {
        if(!preg_match('/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', trim($email)))
        {
            return FALSE;
        }
        return TRUE;
    }
    
    public static function name($name)
    {
        if(!preg_match('/^[a-zа-я ]{3,20}$/i', trim($name)))
        {
            return FALSE;
        }
        
        return TRUE;
    }
    
    public static function num($num)
    {
        $num = (int) abs($num);
        return $num < 1 ? 1 : $num;
    }
    
    public static function escape_html($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
    
    public static function purifyHTML($dirty_html)
    {
        if(self::$html_purifier === NULL)
        {
            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
            
            self::$html_purifier = new HTMLPurifier($config);
        }
        
        return self::$html_purifier->purify($dirty_html);
    }

    public static function getFileExtension($file)
    {
        return substr(strrchr($file, '.'), 1);
    }

    public static function getAvatarPath($user_id, $dim)
    {
        $path = PATH . 'img/avatars/';
        $dir = SPATH . 'img/avatars/' . $user_id . '/';

        $path_arr = array();
        
        if(is_dir($dir))
        {
            $dh = opendir($dir);

            while ($img = readdir($dh))
            {
                $path_arr[] = $img;
            }

            closedir($dh);
        }
        
        if(empty($path_arr))
        {
            $path .= $dim . '_no_avatar.jpg';
        }
        else
        {
            $success = FALSE;

            foreach($path_arr as $file)
            {
                $temp_arr = explode('/', $file);
                $temp_var = $temp_arr[count($temp_arr) - 1];
                if(substr($temp_var, 0, strlen($dim)) == $dim)
                {
                    $path .= $user_id . '/' . $temp_var;
                    $success = TRUE;
                    break;
                }
            }

            if(!$success)
            {
                $path .= $dim . '_no_avatar.jpg';
            }

        }
        
        return $path;
    }
	
	public static function cutText($text, $count)
	{
		$words = explode(" ", $text);
		
		if(count($words) > $count)
		{
			$m = array_chunk($words, $count);
			return implode(" ", $m[0]);
		}
		
		return $text;
	}
    
}