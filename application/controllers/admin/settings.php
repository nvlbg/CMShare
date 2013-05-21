<?php
class Settings extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data['header']['title'] = Language::$admin['settings']['title'];
        $data['content'] = $this->registry->config;
        $data['content']['labels'] = Language::$admin['settings']['l'];

        $data['content']['errors'] = array();

        if(isset($_POST['controller'], $_POST['posts'], $_POST['timezone'], $_POST['footer']))
        {
            $controller = trim($_POST['controller']);
            $per_pages = (int) $_POST['posts'];
            $timezone = trim($_POST['timezone']);
            $footer = $_POST['footer'];

            if(!file_exists(SPATH . 'application/controllers/' . $controller . '.php') || $controller == 'admin')
            {
                $data['content']['errors'][] = Language::$admin['settings']['err']['control'];
            }
            if(!is_numeric($_POST['posts']) || $per_pages <= 0)
            {
                $data['content']['errors'][] = Language::$admin['settings']['err']['pages'];
            }
            if(!$this->checkTimezone($timezone))
            {
                $data['content']['errors'][] = Language::$admin['settings']['err']['zone'];
            }

            if(count($data['content']['errors']) == 0)
            {
                $config = '';
                $config_handle = fopen(SPATH . 'config.ini.php', 'r+');

                while(!feof($config_handle))
                {
                    $line = trim(fgets($config_handle)) . PHP_EOL;

                    if(substr($line, 0, 18) == 'default_controller')
                    {
                        $line = 'default_controller = "' . $controller . '"' . PHP_EOL;
                    }
                    else if(substr($line, 0, 16) == 'default_timezone')
                    {
                        $line = 'default_timezone = "' . $timezone . '"' . PHP_EOL;
                    }
                    else if(substr($line, 0, 9) == 'per_pages')
                    {
                        $line = 'per_pages = ' . $per_pages . PHP_EOL;
                    }
                    else if(substr($line, 0, 6) == 'footer')
                    {
                        $line = 'footer = "' . $footer . '"' . PHP_EOL;
                    }

                    $config .= $line;
                }

                ftruncate($config_handle, filesize(SPATH . 'config.ini.php'));
                rewind($config_handle);
                fwrite($config_handle, rtrim($config));

                fclose($config_handle);

                header('Location: ' . PATH . 'admin/settings/');
                exit();
            }
            else
            {
                foreach($_POST as $k => $v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
            }
        }


        $this->load->admin_template('settings.php', $data);
    }

    private function checkTimezone($timezone)
    {
        return in_array($timezone, DateTimeZone::listIdentifiers());
    }

}