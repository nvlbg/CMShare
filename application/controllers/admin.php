<?php
class admin extends Controller
{

    public function  __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Admin_model.php');
    }

    public function index()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE || ($_SESSION['user_info']['permissions'] != 'a' && $_SESSION['user_info']['permissions'] != 'm'))
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $data = array();

            if(isset($_SESSION['admin_logged_timestamp']) && $_SESSION['admin_logged_timestamp'] < time() - 900)
            {
                $_SESSION['admin_logged'] = FALSE;
            }

            if(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === TRUE)
            {
                $this->loadController();
            }
            elseif(!isset($_POST['admin_name'], $_POST['admin_password']))
            {
                $data['page_title'] = Language::$admin['verify']['page_title'];
                $data['labels']['admin_name'] = Language::$admin['verify']['admin_name'];
                $data['labels']['admin_password'] = Language::$admin['verify']['admin_pass'];
                $data['submit'] = Language::$admin['verify']['submit'];
                $this->load->view('admin/verify.php', $data);
            }
            elseif(!$this->model->checkAdminPass())
            {
                $data['page_title'] = Language::$admin['verify']['page_title'];
                $data['labels']['admin_name'] = Language::$admin['verify']['admin_name'];
                $data['labels']['admin_password'] = Language::$admin['verify']['admin_pass'];
                $data['submit'] = Language::$admin['verify']['submit'];

                $data['errors'][] = Language::$admin['verify']['error'];

                foreach($_POST as $k => $v)
                {
                    $data['inputs'][$k] = $v;
                }

                $this->load->view('admin/verify.php', $data);
            }
            else
            {
                $_SESSION['admin_logged'] = TRUE;
                $_SESSION['admin_logged_timestamp'] = time();

                $this->loadController();
            }
        }
    }

    private function loadController()
    {
        if($this->segment(2) != '' && file_exists(SPATH . 'application/controllers/admin/' . $this->segment(2) . '.php'))
        {
            $controller = $this->segment(2);
            $action = $this->segment(3);

            include SPATH . 'application/controllers/admin/' . $controller . '.php';
            $instance = new $controller();

            if($action != '' && is_callable(array($instance, $action)))
                $instance->$action();
            else
                $instance->index();
        }
        else
        {
            include SPATH . 'application/controllers/admin/feedback.php';
			
            $controller = new Feedback();
            $controller->index();
        }
    }

}