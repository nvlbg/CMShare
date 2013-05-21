<?php
class Login extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Login_model.php');
    }
    
    public function index()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] !== TRUE)
        {
            if(isset($_POST['username']) && $_POST['username'] != '')
            {
                if($this->model->login_check($_POST['username'], $_POST['password']) !== FALSE)
                {
                    header('Location: ' . PATH);
                    exit();
                }
                else
                {
                    $data['header']['page_title'] = Language::$login_title;
                    $data['header']['login_form']['user_input'] = $_POST['username'];
                    $data['content']['message'] = Language::$login_errors['wrong'];
                    $this->load->template('message.php', $data);
                }
                $this->load->template('login_view.php', $data);
            }
            else
            {
                header('Location: ' . PATH);
                exit();
            }
        }
        else
        {
            $data['header']['page_title'] = Language::$login_errors['title'];
            $data['content']['message'] = Language::$login_errors['logged_in'];
            $this->load->template('message.php', $data);
        }
    }
    
    public function logout()
    {
        if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE)
        {
            $this->model->logout();
            $_SESSION['is_logged'] = FALSE;
            session_destroy();
        }
        
        header('Location: ' . PATH);
        exit();
    }
}