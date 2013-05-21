<?php
//TODO documentation
if(file_exists(SPATH . 'config.ini.php'))
{
    extract(parse_ini_file(SPATH . 'config.ini.php'));
    define('PATH', $path);
    define('SITE_NAME', $site_name);
    define('LOGO_COLOR', $color);
    define('LOGO_SHADOW', $shadow);
    define('LOGO_SHADOWX', $sx);
    define('LOGO_SHADOWY', $sy);
    define('LOGO_BLUR', $blur);
    define('FOOTER', $footer);
    define('POSTS_PER_PAGES', $per_pages);
    date_default_timezone_set($default_timezone);

    $config = array(
        'default_timezone' => $default_timezone,
        'default_controller' => $default_controller,
        'per_pages' => $per_pages,
        'footer' => $footer
    );
}

if(!isset($default_controller))
{
    $default_controller = 'home';
}

$autoload_classes = array(
                        'database' => 'DB',
                        'segment'  => 'segment'
                    );

session_start();

// echo $_COOKIE['language'];

// Include language pack
switch(isset($_COOKIE['language']) ? $_COOKIE['language'] : '')
{
    case 'bg':
        include SPATH . 'application/language_packs/bg.php';
        break;
    case 'en':
        include SPATH . 'application/language_packs/en.php';
        break;

    default:
        include SPATH . 'application/language_packs/en.php';
        break;
}

Language::init();

// Include system classes
include SPATH . 'system/Registry.php';
include SPATH . 'system/load.php';
include SPATH . 'system/router.php';
include SPATH . 'system/classes/model.php';
include SPATH . 'system/classes/controller.php';
include SPATH . 'system/classes/htmlpurifier-4.3.0/HTMLPurifier.auto.php';
//include SPATH . 'system/classes/DB.php';
//include SPATH . 'system/classes/segment.php';
//include SPATH . 'system/classes/logging.php';
include SPATH . 'system/classes/Paginator.php';
include SPATH . 'system/classes/validate.php';

$registry = Registry::getInstance();
$registry->putObject('load', Load::getInstance());
$registry->router = new Router($registry);
$registry->config = $config;

foreach($autoload_classes as $key => $value)
{
    $registry->putObject($key, $value);
}

if(isset($db_server))
{
	// Open DB connection
    try
    {
        $registry->database->connect($db_server, $db_username, $db_password, $database);
    }
    catch (Exception $e)
    {
        die($e->getMessage());
    }
	
	try
	{
		// Update online users
		updateUsers($registry, $default_controller);
	}
	catch (Exception $e) { }

	// Load controller or 404
	loadController($registry, $default_controller);
	
	// Close datebase connection
    $registry->database->close();
}
elseif($registry->segment->segment(1) == 'install')
{
	// Load install controller
	loadController($registry, $default_controller);
}
else
{
	die("Sorry, we don't have database connection.");
}

function loadController($registry, $default_controller)
{
	$registry->router->setDefaultController($default_controller);
	try
	{
		$registry->router->loadController();
	}
	catch(Exception $e)
	{
		header('HTTP/1.0 404 Not Found');
		$registry->load->view('404.html');
	}
}

function updateUsers($registry)
{
    $db = $registry->database->getConnection();
	
	$stmt = $db->prepare('SHOW TABLES LIKE "online_users"');
	$stmt->execute();
	$stmt->store_result();
	
	if($stmt->num_rows == 0)
	{
		return;
	}
	
    $ten_minutes_ago = time() - 600;
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE)
    {
        $stmt = $db->prepare('SELECT user_id FROM online_users WHERE user_id = ? AND last_seen < ?');
        $stmt->bind_param('ii', $_SESSION['user_info']['user_id'], $ten_minutes_ago);
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        if($num_rows > 0)
        {
            $_SESSION['is_logged'] = FALSE;
            session_destroy();
        }
        else
        {
            $now = time();
            $stmt = $db->prepare('UPDATE online_users SET last_seen = ? WHERE user_id = ?');
            $stmt->bind_param('ii', $now, $_SESSION['user_info']['user_id']);
            $stmt->execute();
            $stmt->close();
        }
    }
	
    $stmt = $db->prepare('DELETE FROM online_users WHERE last_seen < ?');
    $stmt->bind_param('i', $ten_minutes_ago);
    $stmt->execute();
}