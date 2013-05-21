<?php
class Install_model
{

	private $mysqli = null;

    public function checkDataBaseConnection($server, $user, $pass)
    {
        $this->mysqli = @new mysqli($server, $user, $pass);
        if(mysqli_connect_error())
        {
            return FALSE;
        }
        return TRUE;
    }
	
    public function createDatabase($db, $server, $user, $pass)
    {
        if(!Validate::strlen($db, 64) || !preg_match('/^[0-9a-z\$\_]+$/i', $db))
        {
            return FALSE;
        }

        $this->mysqli->query('CREATE DATABASE IF NOT EXISTS ' . $db);
        $this->mysqli->query('DROP DATABASE ' . $db);
        $this->mysqli->query('CREATE DATABASE ' . $db);

        $this->mysqli->select_db($db);

        $structure = file_get_contents(SPATH . 'application/database.sql');
        $this->mysqli->multi_query($structure);

        return TRUE;
    }

    public function saveConnection($server, $user, $pass, $db)
    {
        $server = trim($server);
        $user   = trim($user);
        $pass   = trim($pass);
        $db     = trim($db);
        
        $buffer = ';<?php die(); ?>';
        $buffer .= PHP_EOL . PHP_EOL;
        $buffer .= '[db_conf]';
        $buffer .= PHP_EOL . PHP_EOL;
        
        $buffer .= 'db_server = "' . $server . "\"" . PHP_EOL;
        $buffer .= 'db_username = "' . $user . "\"" . PHP_EOL;
        $buffer .= 'db_password = "' . $pass . "\"" . PHP_EOL;
        $buffer .= 'database = "' . $db . "\"" . PHP_EOL;

        if(file_put_contents(SPATH . 'config.ini.php', $buffer) !== FALSE)
        {
            return TRUE;
        }
        
        return FALSE;
    }

    public function saveSiteInfo($siteName, $controller, $path, $timezone)
    {
        $siteName   = trim($siteName);
        $controller = trim($controller);
        $path       = trim($path);
        $timezone   = trim($timezone);

        $buffer = file_get_contents(SPATH . 'config.ini.php');

        $buffer .= PHP_EOL . PHP_EOL;
        $buffer .= '[config]';
        $buffer .= PHP_EOL . PHP_EOL;

        $buffer .= 'site_name = "' . $siteName . '"' . PHP_EOL;
        $buffer .= 'default_controller = "' . $controller . '"' . PHP_EOL;
        $buffer .= 'path = "' . $path . '"' . PHP_EOL;
        $buffer .= 'default_timezone = "' . $timezone . '"' . PHP_EOL;
        $buffer .= 'per_pages = 10' . PHP_EOL;
        $buffer .= 'footer = ""' . PHP_EOL;

        if(file_put_contents(SPATH . 'config.ini.php', $buffer) !== FALSE)
        {
            return TRUE;
        }

        return FALSE;
    }

    public function checkController($controller)
    {
        return file_exists(SPATH . 'application/controllers/' . $controller . '.php');
    }

    public function checkURL($url)
    {
        $url = trim($url);
		
        if($url == '')
        {
            return FALSE;
        }
		
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = filter_var($url, FILTER_VALIDATE_URL);
		
        if($url === FALSE)
        {
            return FALSE;
        }
		
        if($url[strlen($url) - 1] != '/')
        {
            $url .= '/';
        }

        return $url;
    }

    public function checkTimezone($timezone)
    {
        return in_array($timezone, DateTimeZone::listIdentifiers());
    }

    public function isValidAdminName($str)
    {
        if(Validate::strlen($str, 32) && Validate::strlen_min($str, 4))
        {
            return TRUE;
        }
        return FALSE;
    }

    public function isValidPassword($pass)
    {
        return Validate::strlen_min($pass, 6);
    }

    public function isValidSex($sex)
    {
        if($sex == 'f' || $sex == 'm')
        {
            return TRUE;
        }
        return FALSE;
    }

    public function saveAdminInfo($name, $pass, $sex)
    {
        $time = time();
        $name = trim($name);
        $pass = sha1($name.trim($pass));
		
		$registry = Registry::getInstance();
		$db = $registry->database->getConnection();
		
        $db->query('SET names utf8');
        $stmt = $db->prepare('INSERT INTO users (username, password, date_registred, sex, permissions) VALUES (?, ?, ?, ?, "a")');
        $stmt->bind_param('ssis', $name, $pass, $time, $sex);
        return $stmt->execute();
    }
	
	public function saveLogo()
	{
		$buffer = file_get_contents(SPATH . 'config.ini.php');

        $buffer .= PHP_EOL . PHP_EOL;
        $buffer .= '[logo]';
        $buffer .= PHP_EOL . PHP_EOL;
		
		$buffer .= 'color = "#D12"' . PHP_EOL;
		$buffer .= 'blur = "4"' . PHP_EOL;
		$buffer .= 'sx = "2"' . PHP_EOL;
		$buffer .= 'sy = "2"' . PHP_EOL;
		$buffer .= 'shadow = "#000"' . PHP_EOL;
		
		file_put_contents(SPATH . 'config.ini.php', $buffer);
	}

}