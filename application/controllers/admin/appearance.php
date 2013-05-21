<?php
class Appearance extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if(isset($_POST['title']))
        {
            $config = '';
            $config_handle = fopen(SPATH . 'config.ini.php', 'r+');
            
            $blur = FALSE;
            $x = FALSE;
            $y = FALSE;
            
            if(isset($_POST['blur']))
            {
                $blur = (int) $_POST['blur'];
                
                if($blur < 0)
                    $blur = 0;
                else if($blur > 100)
                    $blur = 100;
            }
            
            if(isset($_POST['shadowX']))
            {
                $x = (int) $_POST['shadowX'];
                
                if($x < -50)
                    $x = -50;
                else if($x > 50)
                    $x = 50;
            }
            
            if(isset($_POST['shadowY']))
            {
                $y = (int) $_POST['shadowY'];
                
                if($y < -50)
                    $y = -50;
                else if($y > 50)
                    $y = 50;
            }
            
            while(!feof($config_handle))
            {
                $line = trim(fgets($config_handle)) . PHP_EOL;
                
                if(substr($line, 0, 9) == 'site_name')
                {
                    $line = 'site_name = "' . $_POST['title'] . '";' . PHP_EOL;
                }
                else if(Validate::color($_POST['textColor']) && substr($line, 0, 5) == 'color')
                {
                    $line = 'color = "' . trim($_POST['textColor']) . '";' . PHP_EOL;
                }
                else if($blur !== FALSE && substr($line, 0, 4) == 'blur')
                {
                    $line = 'blur = "' . $blur . '";' . PHP_EOL;
                }
                else if($x !== FALSE && substr($line, 0, 2) == 'sx')
                {
                    $line = 'sx = "' . $x . '";' . PHP_EOL;
                }
                else if($y !== FALSE && substr($line, 0, 2) == 'sy')
                {
                    $line = 'sy = "' . $y . '";' . PHP_EOL;
                }
                else if(Validate::color($_POST['shadowColor']) && substr($line, 0, 6) == 'shadow')
                {
                    $line = 'shadow = "' . trim($_POST['shadowColor']) . '";' . PHP_EOL;
                }
                
                $config .= $line;
            }
			
            ftruncate($config_handle, filesize(SPATH . 'config.ini.php'));
            rewind($config_handle);
            fwrite($config_handle, rtrim($config));
            
            fclose($config_handle);
            
            header('Location: ' . PATH . 'admin/appearance/');
            exit();
        }
        
        $data = array();
        
        $data['header']['title'] = Language::$admin['appearance']['title'];
        $data['content'] = array();
        
        $this->load->admin_template('appearance.php', $data);
    }
    
}