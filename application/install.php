<?php
class Install extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Install_model.php');
    }

    public function index()
    {
        if(!isset($_SESSION['install_step']))
        {
            $_SESSION['install_step'] = 0;
        }
        
        $this->switchMethod();
    }
    
    private function switchMethod()
    {
        switch($_SESSION['install_step'])
        {
            case 0:
                $this->init();
                break;
            case 1:
                $this->siteInfo();
                break;
            case 2:
                $this->adminInfo();
                break;
            case 3:
                $this->finish();
                break;

            default:
                $this->init();
        }
    }

    private function savePostData()
    {
        $data = array();
        foreach($_POST as $k => $v)
        {
            $data[$k] = $v;
        }
        return $data;
    }

    private function init()
    {
        $data = array();

        if(isset($_POST['mysql-server'], $_POST['mysql-user'], $_POST['mysql-pass'], $_POST['mysql-db']))
        {
            if(!function_exists('mysqli_connect'))
            {
                $data['errors'][] = Language::$install['errors'][1];
            }
            elseif(!$this->model->checkDataBaseConnection($_POST['mysql-server'], $_POST['mysql-user'], $_POST['mysql-pass']))
            {
                $data['errors'][] = Language::$install['errors'][2];
            }
			elseif(!$this->model->createDatabase($_POST['mysql-db'], $_POST['mysql-server'], $_POST['mysql-user'], $_POST['mysql-pass']))
			{
				$data['errors'][] = Language::$install['errors'][3];
			}
            elseif(!$this->model->saveConnection($_POST['mysql-server'], $_POST['mysql-user'], $_POST['mysql-pass'], $_POST['mysql-db']))
            {
                $data['errors'][] = Language::$install['errors'][4];
            }
            else
            {
                $_SESSION['install_step'] += 1;
                $this->switchMethod();
                die();
            }
			
			if(isset($data['errors']))
			{
				$data['data']['inputs'] = $this->savePostData();
			}
        }
		
		
        $data['steps'] = Language::$install['step'];
        $data['stage'] = 'install_mysql.php';
        $data['data']['mysqli'] = function_exists('mysqli_connect');
        $data['data']['hints'] = Language::$install['mysql'];
        $data['data']['next'] = Language::$install['next'];
        $data['title'] = Language::$install['title']['database'];
        $data['current'] = 1;
        
        $this->load->view('install/install.php', $data);
    }
    
    private function siteInfo()
    {
        $data = array();
		
        if(isset($_POST['site-name'], $_POST['index-page'], $_POST['path'], $_POST['timezone']))
        {
            $url = $this->model->checkURL($_POST['path']);

            if(!$this->model->checkController($_POST['index-page']))
            {
                $data['errors'][] = Language::$install['errors'][5];
            }
            if(!$url)
            {
                $data['errors'][] = Language::$install['errors'][6];
            }
            if(!$this->model->checkTimeZone($_POST['timezone']))
            {
                $data['errors'][] = Language::$install['errors'][7];
            }
            
            if(count($data['errors']) == 0)
            {
                if(!$this->model->saveSiteInfo($_POST['site-name'], $_POST['index-page'], $url, $_POST['timezone']))
                {
                    $data['errors'][] = Language::$install['errors'][4];
                }
                else
                {
                    $_SESSION['install_step'] += 1;
                    $this->switchMethod();
                    die();
                }
            }
			
			if(isset($data['errors']))
			{
				$data['data']['inputs'] = $this->savePostData();
			}
        }

        $data['steps'] = Language::$install['step'];
        $data['stage'] = 'install_site.php';
        $data['data']['hints'] = Language::$install['site'];
        $data['data']['next'] = Language::$install['next'];
        $data['title'] = Language::$install['title']['site'];
        $data['current'] = 2;

        $this->load->view('install/install.php', $data);
    }

    private function adminInfo()
    {
        $data = array();

        if(isset($_POST['admin-name'], $_POST['admin-pass'], $_POST['sex']))
        {
            if(!$this->model->isValidAdminName($_POST['admin-name']))
            {
                $data['errors'][] = Language::$install['errors'][8];
            }
            if(!$this->model->isValidPassword($_POST['admin-pass']))
            {
                $data['errors'][] = Language::$install['errors'][9];
            }
            if(!$this->model->isValidSex($_POST['sex']))
            {
                $data['errors'][] = Language::$install['errors'][10];
            }

            if(count($data['errors']) == 0)
            {
                if(!$this->model->saveAdminInfo($_POST['admin-name'], $_POST['admin-pass'], $_POST['sex']))
                {
                    $data['errors'][] = Language::$install['errors'][4];
                }
                else
                {
                    $_SESSION['install_step'] += 1;
                    $this->switchMethod();
                    die();
                }
            }
        }

        if(isset($data['errors']))
        {
            $data['data']['inputs'] = $this->savePostData();
        }

        $data['steps'] = Language::$install['step'];
        $data['stage'] = 'admin.php';
        $data['data']['finish'] = Language::$install['finish'];
        $data['title'] = Language::$install['title']['admin'];
        $data['current'] = 3;

        $this->load->view('install/install.php', $data);
    }

    private function finish()
    {
        $data = array();
		$this->model->saveLogo();
        $data['title'] = Language::$install['title']['success'];
        $data['message'] = Language::$install['success_message'];
        $this->load->view('install/finish.php', $data);
        $_SESSION['install_step'] = 0;
		unlink(SPATH . 'application/controllers/install.php');
    }

}