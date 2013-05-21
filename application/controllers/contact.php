<?php
class Contact extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['header']['page_title'] = Language::$contact['page_title'];
        $data['content']['labels'] = Language::$contact;
        
        if(!isset($_SESSION['is_logged']))
        {
            $data['content']['name_field']  = NULL;
            $data['content']['email_field'] = NULL;
        }
        else
        {
            $data['content']['name_field'] = $_SESSION['user_info']['fname'];
            $data['content']['email_field'] = $_SESSION['user_info']['email'];
        }
        $this->load->template('contact_view.php', $data);
    }
    
    public function send()
    {
        $errors = array();
        if(!$this->isValid($_POST['c-name']))
        {
            $errors[] = Language::$contact_errors['name'];
        }
        if(!$this->isValid($_POST['c-title']))
        {
            $errors[] = Language::$contact_errors['title'];
        }
        if(!$this->isValidMessage($_POST['c-message']))
        {
            $errors[] = Language::$contact_errors['message'];
        }
        if(!$this->isValidEmail($_POST['c-email']))
        {
            $errors[] = Language::$contact_errors['email'];
        }

        if(count($errors) == 0)
        {
            $this->model = $this->load->model('Contact_model.php');
            if($this->model->save($_POST['c-name'], $_POST['c-title'], $_POST['c-message'], $_POST['c-email']))
            {
                if(isset($_POST['ajax']) && $_POST['ajax'] == TRUE)
                {
                    echo -1;
                    die();
                }

                $data['header']['page_title'] = Language::$contact['page_title'];
                $data['content']['message'] = Language::$contact['succeeded_message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                if(isset($_POST['ajax']) && $_POST['ajax'] == TRUE)
                {
                    echo Language::$contact_errors['unknown_message'];
                    die();
                }

                $data['header']['page_title'] = Language::$contact_errors['unknown_title'];
                $data['content']['message'] = Language::$contact_errors['unknown_message'];
                $this->load->template('message.php', $data);
            }
        }
        else
        {
            if(isset($_POST['ajax']) && $_POST['ajax'] == TRUE)
            {
                echo $errors[0];
                die();
            }

            $data['header']['page_title'] = Language::$contact['page_title'];
            $data['content']['labels'] = Language::$contact;
            $data['content']['errors'] = $errors;
            foreach($_POST as $v)
            {
                $data['content']['inputs'][] = $v;
            }
            $this->load->template('contact_view.php', $data);
        }
    }
    
    private function isValid($str)
    {
        if(mb_strlen(trim($str)) > 0 && mb_strlen($str) < 56)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    private function isValidMessage($message)
    {
        if(mb_strlen(trim($message)) > 0 && mb_strlen($message) < 500)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    private function isValidEmail($email)
    {
        $trimmed_email = trim($email);
        if(strlen($trimmed_email) > 50)
        {
            return FALSE;
        }
        elseif(!preg_match('/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $trimmed_email))
        {
            return FALSE;
        }

        return TRUE;
    }
    
}