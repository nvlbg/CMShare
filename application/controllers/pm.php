<?php
class Pm extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('PM_model.php');
    }
    
    public function index()
    {
        $this->inbox();
    }
    
    public function inbox()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $messages = $this->model->getMessages();
            
            if($messages === FALSE)
            {
                $data['header']['page_title'] = Language::$pm['none_title'];
                $data['content']['message'] = Language::$pm['none_message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                $data['content'] = $messages;
                $data['header']['page_title'] = '(' . $messages['messages']['cnt'] . ') ' . Language::$pm['inbox_title'];
                
                $data['content']['pm_menu'] = Language::$pm['menu'];
                $data['content']['delete'] = Language::$pm['delete'];
                $data['content']['active'] = 'inbox';
                
                $data['no_sections'] = TRUE;
                $this->load->template('pm_view.php', $data);
            }
        }
    }
    
    public function read()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $messages = $this->model->getReadMessages();
            if($messages === FALSE)
            {
                $data['header']['page_title'] = Language::$pm['no_messages_title'];
                $data['content']['message'] = Language::$pm['no_messages_message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                $data['content'] = $messages;
                $data['header']['page_title'] = Language::$pm['title'];
                
                $data['content']['pm_menu'] = Language::$pm['menu'];
                $data['content']['delete'] = Language::$pm['delete'];
                $data['content']['active'] = 'read';
                
                $data['no_sections'] = TRUE;
                $this->load->template('pm_view.php', $data);
            }
        }
    }
    
    public function unread()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $messages = $this->model->getUnReadMessages();
            if($messages === FALSE)
            {
                $data['header']['page_title'] = Language::$pm['no_messages_title'];
                $data['content']['message'] = Language::$pm['no_messages_message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                $data['content'] = $messages;
                $data['header']['page_title'] = Language::$pm['title'];
                
                $data['content']['pm_menu'] = Language::$pm['menu'];
                $data['content']['delete'] = Language::$pm['delete'];
                $data['content']['active'] = 'unread';
                
                $data['no_sections'] = TRUE;
                $this->load->template('pm_view.php', $data);
            }
        }
    }
    
    public function sent()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $messages = $this->model->getSent();
            if($messages === FALSE)
            {
                $data['header']['page_title'] = Language::$pm['none_sent_title'];
                $data['content']['message'] = Language::$pm['none_sent_message'];
                $this->load->template('message_2.php', $data);
            }
            else
            {
                $data['content'] = $messages;
                $data['header']['page_title'] = Language::$pm['sent_title'];
                
                $data['content']['pm_menu'] = Language::$pm['menu'];
                $data['content']['active'] = 'sent';
                $data['content']['delete'] = Language::$pm['delete'];
                $data['no_sections'] = TRUE;
                $this->load->template('pm_view.php', $data);
            }
        }
    }
    
    public function send()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            $data['content'] = array();
            if(isset($_POST['send-user'], $_POST['send-title'], $_POST['send-message']))
            {
                $to = trim($_POST['send-user']);
                $title = trim($_POST['send-title']);
                $message = trim($_POST['send-message']);
                if($title == '')
                {
                    $data['content']['errors'][] = Language::$pm['send_errors']['no_title'];
                }
                if($message == '')
                {
                    $data['content']['errors'][] = Language::$pm['send_errors']['no_message'];
                }
                if($to == '')
                {
                    $data['content']['errors'][] = Language::$pm['send_errors']['no_reciever'];
                }

                $user_id = $this->model->isUser($to);
                if($user_id === FALSE)
                {
                    $data['content']['errors'][] = Language::$pm['send_errors']['no_user'];
                }

                if(count($data['content']['errors']) == 0)
                {
                    $this->model->send($message, $title, $user_id);

                    $data = array();

                    $data['header']['page_title'] = Language::$pm['send_title'];
                    $data['content']['message'] = Language::$pm['send_success'];
                    $this->load->template('message_2.php', $data);
                    
                    die();
                }
            }
			
            if(count($data['content']['errors']) > 0)
            {
                $data['content']['inputs'] = $this->savePostData();
            }
			
            if(is_numeric($this->segment(3)) && !isset($data['content']['inputs']['send-user']))
            {
                $data['content']['inputs']['send-user'] = $this->model->getUsername($this->segment(3));
            }
			
            $data['header']['page_title'] = Language::$pm['send_title'];
            $this->load->template('send_view.php', $data);
        }
    }
    
    public function delete()
    {
        if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE)
        {
            header('Location: ' . PATH);
            exit();
        }
        else
        {
            if($this->segment(3) != '')
            {
                $this->model->delete($this->segment(3));   
            }
            
            $this->inbox();
        }
    }
    
    public function message()
    {
        $data = array();
        $message = $this->model->getMessage();
        if($message === FALSE)
        {
            $data['header']['page_title'] = Language::$pm['no_message_title'];
            $data['content']['message'] = Language::$pm['no_message_message'];
            $this->load->template('message.php', $data);
        }
        else
        {
            $data['content']['message'] = $message;
            $data['header']['page_title'] = $message['title'];
            $data['no_sections'] = TRUE;
            $this->load->template('message_view.php', $data);
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

}