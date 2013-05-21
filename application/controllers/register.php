<?php
class Register extends Controller
{

    private $errors = null;
    
    public function  __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Register_model.php');
        $this->errors = array();
    }
    
    public function index()
    {
        $data = array();
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            $data['header']['page_title'] = Language::$register['title'];
            $data['content']['labels'] = Language::$register_labels;
            $this->load->template('register_view.php', $data);
        }
        else
        {
            $data['header']['page_title'] = Language::$register['error'];
            $data['content']['message'] = Language::$login_errors['logged_in'];
            $this->load->template('message.php', $data);
        }
    }

    public function register()
    {
        $data = array();
        if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE)
        {
            $data['header']['page_title'] = Language::$register['error'];
            $data['content']['message'] = Language::$login_errors['logged_in'];
            $this->load->template('message.php', $data);
        }
        else
        {
            $errors = $this->model->validate();

            if(isset($_POST['ajax']) && $_POST['ajax'] == true)
            {
                if(count($errors) == 0)
                {
                    $this->model->register($_POST['r-username'], $_POST['r-password'], $_POST['email'], $_POST['first-name'], $_POST['last-name'], $_POST['sex'], $_POST['description']);
                    echo -1;
                }
                else
                {
                    echo $errors[0];
                }
                
                die();
            }

            $data['header']['page_title'] = Language::$register['title'];
            if(count($errors) == 0)
            {
                $this->model->register($_POST['r-username'], $_POST['r-password'], $_POST['email'], $_POST['first-name'], $_POST['last-name'], $_POST['sex'], $_POST['description']);
                $data['content']['message'] = Language::$register['message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                foreach($_POST as $k => $v)
                {
                    $data['content']['inputs'][$k] = $v;
                }
                $data['content']['labels'] = Language::$register_labels;
                $data['content']['errors'] = $errors;
                $this->load->template('register_view.php', $data);
            }
        }
    }
}