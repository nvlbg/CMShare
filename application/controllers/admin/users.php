<?php
class Users extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Users_admin.php');
    }
    
    public function index()
    {
        header('Location: ' . PATH . 'admin/users/edit/');
        exit();
    }
    
    public function add()
    {
        $data = array();
        $data['content'] = array();
        
        $data['header']['title'] = Language::$admin['user_add']['title'];
        $data['content']['labels'] = array_merge(Language::$register_labels, Language::$admin['user_add']);
        
        if(isset($_POST['check']) && $_POST['check'] == $_SESSION['check'])
        {
            $register_model = $this->load->model('Register_model.php');
            $errors = $register_model->validate();
            
            if(count($errors) == 0)
            {
                $permissions = $_POST['permissions'] == 'm' ? 'm' : 'n';
                $register_model->register($_POST['r-username'], $_POST['r-password'], $_POST['email'], '', '', $_POST['sex'], '', $permissions);
                $data['content']['success'] = Language::$admin['user_add']['success'];
            }
            else
            {
                foreach($_POST as $k => $v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
                $data['content']['errors'] = $errors;
            }
            
        }
        
        $_SESSION['check'] = time();
        $data['content']['check'] = $_SESSION['check'];
        
        $this->load->admin_template('add_user.php', $data);
    }
    
    public function edit()
    {
        $data = array();
        $data['content'] = array();
        
        if(is_numeric($this->segment(4)))
        {
            if(!$this->model->userExists($this->segment(4)))
            {
                header('Location: ' . PATH . 'admin/users/edit/');
                exit();
            }
            
            $data['content']['labels'] = Language::$admin['user_edit'];
            $data['content']['labels']['edit_coms'] = Language::$admin['article_w_l']['edit_coms'];
            
            if(isset($_POST['check']) && $_POST['check'] == $_SESSION['check'])
            {
                $errors = array();
                
                if(isset($_POST['remove-avatar']) && $_POST['remove-avatar'] == 1)
                {
                    $pathname = SPATH . 'img/avatars/' . ((int) $this->segment(4)) . '/';
                    if(is_dir($pathname))
                    {
                        $dh = opendir($pathname);
                        while($img = readdir($dh))
                        {
                            if(!is_dir($img))
                            {
                                @unlink($pathname . $img);
                            }
                        }
                        closedir($dh);
                    }
                }
                
                if(strlen($_POST['fname']) > 0)
                {
                    if(!Validate::strlen($_POST['fname'], 20))
                    {
                        $errors[] = Language::$admin['ue_errors']['fn_tl'];
                    }
                    else if(!preg_match('/^[a-zа-я]{3,20}$/i', trim($_POST['fname'])))
                    {
                        $errors[] = Language::$admin['ue_errors']['fn_invalid'];
                    }
                }
                
                if(strlen($_POST['lname']) > 0)
                {
                    if(!Validate::strlen($_POST['lname'], 20))
                    {
                        $errors[] = Language::$admin['ue_errors']['ln_tl'];
                    }
                    else if(!preg_match('/^[a-zа-я]{3,20}$/i', trim($_POST['lname'])))
                    {
                        $errors[] = Language::$admin['ue_errors']['ln_invalid'];
                    }
                }
                
                if(!Validate::strlen($_POST['description'], 400))
                {
                    $errors[] = Language::$admin['ue_errors']['desc'];
                }
                
                if(count($errors) == 0)
                {
                    if(!$this->model->editUser($this->segment(4)))
                    {
                        $errors[] = Language::$admin['ue_errors']['unknown'];
                    }
                    else
                    {
                        $data['content']['success'] = Language::$admin['ue_errors']['success'];
                    }
                }
                
                if(count($errors) > 0)
                {
                    $data['content']['errors'] = $errors;
                    foreach($_POST as $k => $v)
                    {
                        $data['content']['inputs'][$k] = $v;
                    }
                }
            }
            
            $data['content']['user_info'] = $this->model->getUserInfo($this->segment(4));
            $data['header']['title'] = $data['content']['user_info']['username'];
            
            $_SESSION['check'] = time();
            $data['content']['check'] = $_SESSION['check'];
            $data['content']['user_id'] = (int) $this->segment(4);
            
            $this->load->admin_template('edit_user.php', $data);
        }
        else
        {
            $data['header']['title'] = Language::$admin['users_edit']['title'];
            $data['content'] = $this->model->getUsers();
			
            if(!isset($data['content']['users']))
            {
                    $data['content']['users'] = array();
            }
			
            $data['content']['labels'] = Language::$admin['users_edit'];
            
            $_SESSION['check'] = time();
            $data['content']['check'] = $_SESSION['check'];
            
            $this->load->admin_template('edit_users.php', $data);
        }
    }
    
    public function delete()
    {
        if(isset($_POST['delete'], $_POST['check']) && count($_POST['delete']) > 0 && $_POST['check'] == $_SESSION['check'])
        {
            $this->model->deleteUsers($_POST['delete']);
        }
        
        header('Location: ' . PATH . 'admin/users/edit/');
        exit();
    }
    
}