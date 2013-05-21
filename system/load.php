<?php
class Load
{
    
    private static $instance = null;
    
    private function __construct() { }
    
    public function __clone() { trigger_error('The class cannot be cloned!'); }
    
    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new Load();
        }
        return self::$instance;
    }
    
    public function view($file_name, $data = null)
    {
        if(is_array($data))
        {
            extract($data);
        }
        include SPATH . 'application/views/' . $file_name;
    }
    
    public function template($main_content, $data = null)
    {
        $load = self::$instance;
        
        if(is_array($data))
        {
            extract($data);
        }

        if(isset($_POST['ajaxauto']))
        {
            //TODO not load view but json
            //header('Cache-Control: no-cache, must-revalidate');
            //header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            //header('Content-type: application/json');
            //$result = array();
            //$result['title'] = $header['page_title'];
            //$result['main_content'] = $main_content;
            //$result['content'] = $content;
            //echo json_encode($result);
            $this->view($main_content, $content);
            die();
        }
        
        $model = $load->model('Shared_model.php');

        if(file_exists(SPATH . 'menu.ini.php'))
        {
            $header['main_menu'] = parse_ini_file(SPATH . 'menu.ini.php', TRUE);
        }

        $header['search'] = Language::$main_menu;

        $registry = Registry::getInstance();

        $header['back_to'] = $registry->segment->segment(1) . '/' . $registry->segment->segment(2);

        $footer = array();
        $script = 'js/' . $registry->segment->segment(1) . '.js';
        if(file_exists(SPATH . $script))
        {
            $footer['script'] = PATH . $script;
        }
        

        $sections = $model->getSectionsData();
        $sections['no_sections'] = isset($no_sections) && $no_sections;

        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] !== TRUE)
        {
            $header['user_box'] = 'user_box';
            $header['login_form'] = Language::$login_form;
        }
        else
        {
            $header['user_box'] = 'user_box_logged';
            $header['login_form']['settings'] = Language::$settings;
            $header['login_form']['msg_count'] = $model->getMsgCount();
            $header['login_form']['avatar'] = Validate::getAvatarPath($_SESSION['user_info']['user_id'], 80);
        }
        include SPATH . 'application/views/template.php';
    }

    public function admin_template($main_content, $data = null)
    {
        $load = self::$instance;

        if(is_array($data))
        {
            extract($data);
        }

        if(isset($_POST['ajaxauto']))
        {
            $load->view($main_content, $content);
            die();
        }
        
        $admin_model = new Admin_model();

        $footer = array();
        $footer['last_users'] = $admin_model->getLastFiveUsers();
        $footer['last_comments'] = $admin_model->getLastFiveComments();

        $header['labels'] = Language::$admin['labels_header'];
        $footer['labels'] = Language::$admin['labels_footer'];

        $registry = Registry::getInstance();

        $script = 'js/admin/' . $registry->segment->segment(2) . '.js';
        if(file_exists(SPATH . $script))
        {
            $footer['script'] = PATH . $script;
        }

        include SPATH . 'application/views/template_admin.php';
    }
    
    public function model($file_name)
    {
        include SPATH . 'application/models/' . $file_name;
        $model = substr($file_name, 0, -4);
        $result = new $model();
        return $result;
    }
    
    public function controller($file_name)
    {
        include SPATH . 'application/controllers/' . $file_name;
        $controller = substr($file_name, 0, -4);
        $controller = new $controller();
        $controller->index();
    }

}